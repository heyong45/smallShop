<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/16
 * Time: 22:38
 */

namespace app\api\model;



class Banner extends BaseModel
{
    protected $hidden = ["delete_time","update_time"];
    public function items(){
        //关联模型
        return $this->hasMany('BannerItem',"banner_id",'id');
    }

    //protected $table = "Banner_item";
    public static function getBannerByID($id)
    {
        $banner_info = self::with(["items","items.img"])->find($id);
        //$banner_info->hidden(["delete_time","update_time"]);
        return $banner_info;

    }
}