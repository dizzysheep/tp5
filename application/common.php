<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * @desc 成功返回
 * @param $msg
 * @param $data
 */
if (!function_exists('successJson')) {
    function successJson($msg = 'success', $data = [])
    {
        returnJson(\app\constants\ErrorCode::RET_SUCCESS, $msg, $data);
    }
}


/**
 * @desc 失败返回
 * @param int $code
 * @param string $msg
 */
if (!function_exists('errorJson')) {
    function errorJson($code = \app\constants\ErrorCode::RET_ERROR, $msg = 'system error')
    {
        returnJson($code, $msg);
    }
}

/**
 * @desc 自定义返回
 * @param $code
 * @param string $msg
 * @param array $data
 */
if (!function_exists('returnJson')) {
    function returnJson($code, $msg = '', $data = [])
    {
        json(['code' => $code, 'msg' => $msg, 'data' => $data])->send();
        die;
    }
}