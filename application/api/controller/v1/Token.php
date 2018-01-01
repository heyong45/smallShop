<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/31
 * Time: 14:42
 */

namespace app\api\controller\v1;


use app\api\validate\TokenGet;
use app\api\service\UserToken;

class Token
{
    public function getToken($code)
    {
        (new TokenGet())->goCheck();
        $token = (new UserToken($code))->get();

        return [
            'token' => $token
            ];
    }
}