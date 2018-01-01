<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/17
 * Time: 12:33
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    //http state code
    public $code = 400;
    // error message
    public $msg = "invalid parameters.";
    // custom error code
    public $errorCode = 10000 ;

    public function __construct($params = [])
    {
        if (! is_array($params))
        {
            //throw  new \Exception("参数必须是数组");
            return;
        }
        if(array_key_exists('code',$params))
        {
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params))
        {
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params))
        {
            $this->errorCode = $params['errorCode'];
        }
    }
}