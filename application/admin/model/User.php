<?php

namespace app\admin\model;

use app\admin\traits\SystemTimeTrait;
use app\admin\traits\UserTrait;
use app\constants\Common;
use think\Model;
use traits\model\SoftDelete;

class User extends Model
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
     * @desc 修改
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
     * @desc 获取分页数据
     * @param $pageNo
     * @param $pageSize
     * @param array $params
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList($pageNo, $pageSize, $params = [])
    {
        $where = $this->buildWhere($params);
        return $this->where($where)->page($pageNo, $pageSize)->select();
    }

    /**
     * @desc 查询总数
     * @param array $params
     * @return int|string
     * @throws \think\Exception
     */
    public function getCount($params = [])
    {
        $where = $this->buildWhere($params);
        return $this->where($where)->count();
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
            $where = " and group_id = " . $params['group_id'];
        }

        //用户名/手机号/真实姓名查询
        if (!empty($params['search_key'])) {
            $where = " and ( 
            phone like '%" . $params['search_key'] . "%' 
            or username like '%" . $params['search_key'] . "%'
            or name like '%" . $params['search_key'] . "%'
            )";
        }

        return $where;
    }


}