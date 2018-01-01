<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/26
 * Time: 23:29
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    //读取器
    public function prefixImageUrl($value, $data){
        if($data["from"] == 1)
        {
            return config("setting.img_prefix").$value;
        }
        return $value;
    }

}