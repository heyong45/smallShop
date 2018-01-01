<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/24
 * Time: 23:13
 */

namespace app\api\model;



class BannerItem extends BaseModel
{
    protected $hidden = ["id","img_id","banner_id","update_time","delete_time"];
    public function img(){
        return $this->belongsTo("Image","img_id","id");
    }
}