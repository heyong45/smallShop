<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/16
 * Time: 20:27
 */

namespace app\api\controller\v2;

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

        return "This is V2 Version.";

    }
}