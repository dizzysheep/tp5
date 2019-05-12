<?php

namespace app\admin\model;

use app\constants\Common;
use think\Model;

class User extends Model
{
    /**
     * @desc 密码加密
     * @param $value
     * @return bool|string
     */
    public function setPasswordAttr($value)
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * @desc 将用户密码转化小写
     * @param $value
     * @return bool|string
     */
    public function setUsernameAttr($value)
    {
        return strtolower($value);
    }

    public function getSexAttr($value)
    {
        return Common::SEX_SHOW[$value] ?? '未知';
    }
}