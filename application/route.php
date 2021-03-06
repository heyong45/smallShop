<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\Route;

//Route::rule('hello','/sample/test/hello', 'GET|POST', ['https' =>false]);
//Route::get('hello',"/sample/Test/hello");
//Route::post();
//Route::any();
Route::get("api/:version/banner","api/:version.Banner/getBanner");
Route::get("api/:version/theme","api/:version.Theme/getSimpleList");
Route::get("api/:version/theme/:id","api/:version.Theme/getComplexOne");


/*
Route::get("api/:version/product/by_category/:id","api/:version.Product/getAllInCategory");
Route::get("api/:version/product/:id","api/:version.Product/getOne",[],['id'=>'\d+']);
Route::get("api/:version/product/recent","api/:version.Product/getRecent");
*/
//路由分组:
Route::group('api/:version/product',function(){
    Route::get("/by_category","api/:version.Product/getAllInCategory");
    Route::get("/:id","api/:version.Product/getOne",[],['id'=>'\d+']);
    Route::get("/recent","api/:version.Product/getRecent");
});

Route::get("api/:version/category/all","api/:version.Category/getAllCategores");

Route::post("api/:version/token/user","api/:version.Token/getToken");

Route::post("api/:version/address","api/:version.Address/createOrUpdateAddress");