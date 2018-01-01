<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/16
 * Time: 20:55
 */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{
    //定义验证器
    protected $rule = [
        'name' => 'require|max:10',
        'email' => 'email'
    ];
}