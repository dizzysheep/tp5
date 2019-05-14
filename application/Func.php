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

    /**
     * 字符串变成小驼峰
     * @param $str
     * @return string
     */
    static public function toLittleHump($str)
    {
        $arr = preg_split('/_|-/', $str);
        if (count($arr) == 1) {
            return strtolower($str);
        }

        foreach ($arr as $key => &$value) {
            if ($key == 0) {
                $value = strtolower($value);
            } else {
                $value = ucfirst($value);
            }
        }

        return implode('', $arr);
    }

    /**
     * 字符串变成大驼峰
     * @param $str
     * @return string
     */
    static public function toBigHump($str)
    {
        $arr = preg_split('/_|-/', $str);
        foreach ($arr as &$value) {
            $value = ucfirst($value);
        }
        return implode('', $arr);
    }


    /**
     * @desc 获取类名 例如 base_service \app\admin\service\base
     * @param $obj
     * @param $suffix
     * @return string|string[]|null
     */
    public static function getClassName($obj, $suffix = '')
    {
        $className = get_class($obj);
        $classNameArr = explode('\\', $className);
        if ($classNameArr) {
            $className = end($classNameArr);
        }

        $serviceName = self::toCStyle($className);
        $suffix && $serviceName = preg_replace("/_$suffix/", '', $serviceName);
        $serviceName = trim(self::toBigHump($serviceName));

        return $serviceName;
    }


}