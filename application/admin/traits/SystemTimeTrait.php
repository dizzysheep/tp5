<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-14
 * Time: 11:33
 */

namespace app\admin\traits;


trait SystemTimeTrait
{
    /**
     * @desc 创建时间
     * @param $value
     * @return false|string
     */
    public function getCreateTimeAttr($value)
    {
        return $value ? date('Y-m-d H:i:s') : '';
    }

    /**
     * @desc 修改时间
     * @param $value
     * @return false|string
     */
    public function getUpdateTimeAttr($value)
    {
        return $value ? date('Y-m-d H:i:s') : '';
    }
}