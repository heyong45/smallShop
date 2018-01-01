<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/30
 * Time: 21:49
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        "count"=>"isPositiveInteger|between:1,15"
    ];
}