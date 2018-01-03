<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/31
 * Time: 16:34
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken()
    {
        //生成令牌   32个随机字符
        $randChars = getRandChar(32);

        //用3组字符串进行MD5加密
        $timestamp = $_SERVER['REQUEST_TIME'];

        //salt 盐值
        $salt = config("secure.token_salt");


        return md5($randChars.$timestamp.$salt);
    }

    public static function getCurrentTokenVar($key){
        //从http请求的head里面获取token
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if (!$vars)
        {
            throw new TokenException();
        }
        // 结果不是数组则转换成数组：
        if(!is_array($vars))
        {
            $vars = json_decode($vars, true);
        }
        //检查key值是否在token变量中存在
        if (!array_key_exists($key,$vars))
        {
            throw new Exception(['msg'=>'要获取的token变量不存在。']);
        }
        return $vars[$key];


    }

    public static function getCurrentUID()
    {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
}