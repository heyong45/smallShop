<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/31
 * Time: 13:21
 */

namespace app\api\model;


class Category extends BaseModel
{
    protected $hidden=[
        "delete_time","update_time","topic_img_id","description"
    ];
    public function img()
    {
        return $this->belongsTo('image','topic_img_id',"id");
    }
}