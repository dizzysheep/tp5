<?php

namespace app\admin\model;

use app\admin\traits\SystemTimeTrait;
use app\admin\traits\UserTrait;
use app\common\model\BaseModel;
use app\constants\Common;
use traits\model\SoftDelete;

class UserModel extends BaseModel
{
    use SoftDelete;
    use UserTrait;
    use SystemTimeTrait;

    /**
     * @desc 主键
     * @var string
     */
    protected $pk = 'user_id';

    /**
     * @desc 密码隐藏
     * @var array
     */
    protected $hidden = ['password', 'delete_time'];

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
     * @desc 添加自动写入
     * @var array
     */
    protected $insert = ['create_user_id'];

    /**
     * @desc 修改自动写入
     * @var array
     */
    protected $update = ['update_user_id'];

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

    /**
     * @desc 性别
     * @param $value
     * @return string
     */
    public function getSexAttr($value)
    {
        return Common::SEX_SHOW[$value] ?? '未知';
    }


    /**
     * @desc 处理搜索条件
     * @param $params array
     * @return mixed
     */
    protected function buildWhere(array $params)
    {
        $where = " 1 = 1 ";
        //用户组id查询
        if (!empty($params['group_id'])) {
            $where .= " and group_id = " . $params['group_id'];
        }

        //用户名/手机号/真实姓名查询
        if (!empty($params['search_key'])) {
            $where .= " and ( 
            phone like '%" . $params['search_key'] . "%' 
            or username like '%" . $params['search_key'] . "%'
            or name like '%" . $params['search_key'] . "%'
            )";
        }

        return $where;
    }

    /**
     * @desc 管理权限组的权限列表
     */
    public function groupAuth()
    {
        return $this->hasMany('groupAuthModel', 'group_id');
    }


}