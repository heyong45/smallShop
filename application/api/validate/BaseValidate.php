<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/16
 * Time: 21:49
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http传入的参数
        //对参数做校验
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);
        if(! $result)
        {
            $e = new ParameterException([
                'msg' => $this->error
            ]);
            //$e->msg = $this->error;
            throw $e;
            //$error = $this->getError();
            //throw  new Exception($error);

        }else
        {
            return true;
        }
    }

    //自定义验证规则：
    protected function isPositiveInteger($value, $rule='', $data='', $field=''){
        //data 验证用的数据
        //field 验证数据中的key name
        // value 验证数据的 key value
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }else{
            return false;
        }
    }

    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        if(empty($value))
        {
            return false;
        }
        return true;
    }
    protected  function isMobile($value)
    {
        $rule = '^1(3|4|5|6|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if(!$result)
        {
            return false;
        }
        return true;
    }

    public function getDataByRule($arrays)
    {
        //接收所有参数变量
        if(array_key_exists('user_id',$arrays)|
            array_key_exists('uid',$arrays))
        {
            //不允许包含user_id or uid ，防止恶意覆盖主键；
            throw new ParameterException(['msg' =>'参数包含非法参数']);
        }
        $newArray =[];
        foreach($this->rule as $key => $value)
        {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
}