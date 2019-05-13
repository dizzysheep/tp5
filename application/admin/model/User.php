<?php

namespace app\admin\model;

use app\constants\Common;
use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    use SoftDelete;

    /**
     * @desc 主键
     * @var string
     */
    protected $pk = 'user_id';

    /**
     * @desc 密码隐藏
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * @desc 用户名不允许修改
     * @var array
     */
    protected $readonly = ['username'];

    /**
     * @desc 自动写入时间戳
     * @var bool
     */
    protected $autoWriteTimestamp = true;

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