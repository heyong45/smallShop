<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/16
 * Time: 20:27
 */

namespace app\api\controller\v1;

use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerMissException;
use think\Request;
use app\api\model\Banner as BannerModel;

class Banner
{
    /*
     * 获取制定的banner信息
     *@URL /banner/?id=
     * @http GET
     * @id  Banner的ID号
     */
    public function getBanner(Request $request)
    {
        (new IDMustBePostiveInt())->goCheck();
        $id = $request->get('id');
        $banner_info = BannerModel::getBannerByID($id);
        //$banner_info = BannerModel::get($id);
        //$banner_info = BannerModel::find($id);
        //$banner_info = BannerModel::all();
        //$banner_info = BannerModel::with(["items","items.img"])->find($id);
        //$bannerInstance = new BannerModel();
        //$banner_info = $bannerInstance->get($id);
        if(!$banner_info)
        {
            throw new BannerMissException();
        }
        $c = config('setting.img_prefix');
        return $banner_info;

    }
}