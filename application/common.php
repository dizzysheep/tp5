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
 * @desc 成功response返回
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
 * @desc 失败response返回
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
 * @desc 自定义response返回
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

/**
 * @desc success格式化返回数据
 */
if (!function_exists('successReturn')) {
    function successReturn($msg = 'success', $data = [])
    {
        return formatterReturn(\app\constants\ErrorCode::RET_SUCCESS, $msg, $data);
    }
}

/**
 * @desc error格式化返回数据
 */
if (!function_exists('errorReturn')) {
    function errorReturn($code = \app\constants\ErrorCode::RET_ERROR, $msg = 'success', $data = [])
    {
        return formatterReturn($code, $msg, $data);
    }
}

/**
 * @desc formatterReturn格式化返回数据
 */
if (!function_exists('formatterReturn')) {
    function formatterReturn($code, $msg = '', $data = [])
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }
}

if (!function_exists('service')) {
    /**
     * 实例化Model
     * @param string $name Model名称
     * @param string$layer 业务层名称
     * @param string $appendSuffix 是否添加类名后缀
     * @return object
     */
    function service($name = '', $layer = 'service', $appendSuffix = 'service')
    {
        return \think\Loader::model($name, $layer, $appendSuffix);
    }
}