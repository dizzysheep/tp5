<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-13
 * Time: 19:54
 */

namespace app;


use think\Loader;

class Func
{
    /**
     * @desc json格式化数据
     * @param $data
     * @return false|string
     */
    public static function jsonEncode($data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @desc 将驼峰字符串转化成C风格
     * @param $str
     * @return string
     */
    public static function toCStyle($str)
    {
        return strtolower(trim(preg_replace("/([A-Z])/", "_$1", $str), ' _'));
    }


    /**
     * @desc 加载service层
     * @param string $name
     * @param string $layer
     * @param bool|mixed $appendSuffix
     * @return object
     */
    public static function loadService($name = '', $layer = 'service', $appendSuffix = 'service')
    {
        return Loader::model($name, $layer, $appendSuffix);
    }

}