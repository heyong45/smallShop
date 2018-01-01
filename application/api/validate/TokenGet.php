<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/31
 * Time: 14:44
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    public $rule=[
      "code" => "require|isNotEmpty"
    ];

    protected $message=[
      "code" => "没有code无法获取token。"
    ];
}