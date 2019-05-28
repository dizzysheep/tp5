<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-28
 * Time: 14:04
 */

namespace app\common;


use think\Request;
use \think\Log;

class AppLog
{
    /**
     * @desc 唯一请求码
     * @var string
     */
    public $unique_no = '';

    /**
     * @desc 日志写入警告信息
     * @param $msg
     * @param $data
     * @param $filePath
     */
    public static function warning($msg, array $data, $filePath = '')
    {
        self::record('warning', $msg, $data, $filePath);
    }

    /**
     * @desc 写入信息
     * @param $msg
     * @param array $data
     * @param string $filePath
     */
    public static function info($msg, array $data, $filePath = '')
    {
        self::record('info', $msg, $data, $filePath);
    }

    /**
     * @desc 写入信息
     * @param $msg
     * @param array $data
     * @param string $filePath
     */
    public static function debug($msg, array $data, $filePath = '')
    {
        self::record('debug', $msg, $data, $filePath);
    }

    /**
     * @desc 写入日志信息
     * @param $level
     * @param $msg
     * @param array $data
     * @param string $filePath
     */
    public static function record($level, $msg, array $data, $filePath = '')
    {
        $request = Request::instance();

        //拼装日志路径
        if (!$filePath) {
            $module = $request->module();
            $controller = $request->controller();
            $action = $request->action();
            $filePath = strtolower($module . DS . $controller . DS . $action . DS);
        }

        //初始化日志信息
        Log::init([
            'type' => 'File',
            'path' => APP_PATH . 'logs/' . $filePath
        ]);

        //写入日志信息
        $array = [
            'msg' => $msg,
            'data' => $data,
            'uniqueNo' => $request->uniqueNo,
        ];

        $info = Func::jsonEncode($array);
        Log::record($info, $level);
    }
}