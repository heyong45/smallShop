<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/17
 * Time: 12:30
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    public function render(\Exception $e)
    {

        if($e instanceof BaseException)
        {
            //  custom exception
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;

        }
        else
        {
            //Config::get('app_debug')
            if(config('app_debug'))
            {
                //return TP5 default Exception info
                return parent::render($e);
            }
            else{
                $this->code = 500;
                $this->msg = "Server inner error.";
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }

        }
        $request = Request::instance();

        $result = [
          'msg' => $this->msg,
          'error_code' => $this->errorCode,
          'request_url' => $request->url(),
        ];
        return json($result,$this->code);
    }

    private function recordErrorLog(\Exception $e)
    {
        Log::init([
            'type'=> 'File',
            'path'=> LOG_PATH,
            'level'=> ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}