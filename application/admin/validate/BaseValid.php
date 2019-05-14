<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-14
 * Time: 10:42
 */

namespace app\admin\validate;


use think\Validate;

class BaseValid extends Validate
{
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
}