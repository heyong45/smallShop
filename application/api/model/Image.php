<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/24
 * Time: 23:24
 */

namespace app\api\model;



class Image extends BaseModel
{
    protected $hidden = ["id","delete_time","update_time","from"];
    public function getUrlAttr($value,$data){
        return $this->prefixImageUrl($value, $data);
    }
}