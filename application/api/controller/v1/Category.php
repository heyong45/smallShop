<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/31
 * Time: 13:19
 */

namespace app\api\controller\v1;
use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

class Category
{
    public function getAllCategores()
    {
        $categroes = CategoryModel::all([],'img');
        if($categroes->isEmpty())
        {
            throw new CategoryException();
        }
        return $categroes;
    }
}