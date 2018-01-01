<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/30
 * Time: 21:46
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ProductException;

class Product
{
    /*
     * 获取最新上传的商品信息
     */
    public function getRecent($count=15)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);

        if($products->isEmpty())
        {
            throw new ProductException();
        }
        /*//得到一个数据集对象：
        $collection = collection($products);
        $products = $collection->hidden(["summary"]);*/
        $products = $products->hidden(["summary"]);
        return $products;
    }

    /*
     * 获取分类下的所有商品
     */
    public function getAllInCategory($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $products = ProductModel::getProductByCatgoryId($id);
        if(!$products)
        {
            throw new ProductException();
        }
        return $products;
    }
}