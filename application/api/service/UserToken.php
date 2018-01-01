<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/31
 * Time: 14:57
 */
namespace app\api\service;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config("wx.appid");
        $this->wxAppSecret = config("wx.app_secret");
        $this->wxLoginUrl = sprintf(config("wx.login_url"),
            $this->wxAppID,$this->wxAppSecret,$this->code);

    }

    public function get()
    {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult))
        {
            throw new Exception("获取session_key和openid失败，微信内部错误。");
        }
        else
        {

            $login_fail = array_key_exists('errcode',$wxResult);
            if($login_fail)
            {
                //从微信服务器获取openid失败,返回失败信息
                $this->processLoginError($wxResult);
            }
            else
            {
                //正常获取到openid,生成Token
                $this->grantToken($wxResult);

            }
        }
        return $wxResult;

    }

    private function grantToken($wxResult)
    {
        //steps:
        //拿到openid
        //检查数据库中是否已存在这个openid，如果没有则说明这是一个新用户，要新增一条用户记录。
        //生成Token
        //准备缓存数据，写入缓存 key:Token  value: wxResult, uid,scope(用户身份）
        //返回Token给客户端

        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if($user)
        {
            $uid = $user->id;
        }
        else{
            $uid = $this->newUser($openid);
        }
        $cacheValue = $this->prepareCachedValue($wxResult, $uid);
        $token = $this->saveToCache($cacheValue);
        return $token;
    }

    private function saveToCache($cacheValue)
    {
        $key = self::generateToken();
        $value  = json_encode($cacheValue);
        $expire_in = config("setting.token_expire_in");

        //写入缓存  默认是文件缓存
        $request =cache($key,$value,$expire_in);
        if(!$request)
        {
            throw new TokenException([
                'msg' => "服务器缓存异常。",
                'errorCode' => 10005
            ]);
        }
        return $key;
    }


    private function prepareCachedValue($wxResult,$uid)
    {
        $cachedValue = $wxResult;
        $cachedValue["uid"] = $uid;
        $cachedValue["scope"] = 16;
        return $cachedValue;
    }

    private function newUser($openid)
    {
        //创建用户，返回id
        $user = UserModel::create(
            [
                "openid" => $openid
            ]
        );
        return $user->id;
    }

    private function processLoginError($wxResult)
    {
        throw  new WeChatException([
            'msg' => $wxResult["errmsg"],
            "errorCode" => $wxResult["errcode"]
        ]);
    }
}