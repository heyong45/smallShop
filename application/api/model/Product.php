<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/27
 * Time: 0:08
 */

namespace app\api\model;


class Product extends BaseModel
{
    protected $hidden = [
        "delete_time","update_time","category_id","pivot","from","create_time"
    ];

    public function getMainImgUrlAttr($value,$data)
    {
        return $this->prefixImageUrl($value, $data);
    }

    public static  function getMostRecent($count)
    {
        $products = self::limit($count) ->order("create_time desc")->select();
        return $products;
    }

    public static function getProductByCatgoryId($id)
    {
        $products = self::where("category_id","=","$id")->select();
        return $products;
    }

    public function imgs()
    {
        return $this->hasMany("ProductImage", 'product_id','id');
    }

    public function  properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getProductDetail($id)
    {
        $product = self::with([
            'imgs' => function($query){
                $query->with(['imgUrl'])->order('order','asc');
            }
        ])
            ->with(['properties'])->find($id);
        return $product;
    }
}