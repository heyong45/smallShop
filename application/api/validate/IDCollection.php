<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/28
 * Time: 23:31
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
      'ids' => "require|checkIDs"
    ];

    //定义返回的信息：
    protected $message=[
        'ids' => 'ids 参数必须是以逗号分隔的一个或多个正整数。'
    ];
    //自定义检查
    protected function checkIDs($value)
    {
        $values = explode(',', $value);
        if(empty($values))
        {
            //不能为空
            return false;
        }
        foreach ($values as $id)
        {
            if(!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }
}