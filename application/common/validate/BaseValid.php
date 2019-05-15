<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-14
 * Time: 10:42
 */

namespace app\common\validate;


use think\Validate;

class BaseValid extends Validate
{

    /**
     * @desc 正整数验证规则
     * @param $value
     * @param $rule
     * @param $data
     * @param $field
     * @return bool|string
     */
    public function positiveInt($value, $rule, $data, $field)
    {
        if (preg_match("/^[1-9][0-9]*$/", $value)) {
            return true;
        }

        return $field . ' 不是正整数';
    }

    /**
     * @desc 最大长度规则
     * @param $value
     * @param $rule
     * @param $data
     * @param $field
     * @return bool|string
     */
    public function maxLength($value, $rule, $data, $field)
    {
        if (strlen($value) <= $rule) {
            return true;
        }

        return $field . ' 最大长度不能超过' . $rule;
    }


}