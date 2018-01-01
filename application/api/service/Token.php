<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/31
 * Time: 16:34
 */

namespace app\api\service;


class Token
{
    public static function generateToken()
    {
        //生成令牌   32个随机字符
        $randChars = getRandChar(32);

        //用3组字符串进行MD5加密
        $timestamp = $_SERVER['ReQUEST_TIME'];

        //salt 盐值
        $salt = config("secure.token_salt");


        return md5($randChars.$timestamp.$salt);
    }

}