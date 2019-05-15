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
     * @desc 自定义处理函数
     */
    public function init()
    {

    }

    /**
     * @desc 获取rule规则
     * @return array
     */
    public function getRuleField()
    {
        return $this->rule;
    }

    /**
     * @desc 获取rule规则
     * @param $scene
     * @return array
     */
    public function getSceneField($scene)
    {
        return $this->scene[$scene] ? array_flip($this->scene[$scene]) : array();
    }

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
     * @desc 正整数验证规则
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