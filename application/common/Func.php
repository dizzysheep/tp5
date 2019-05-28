<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-13
 * Time: 19:54
 */

namespace app\common;


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


}