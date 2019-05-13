<?php

namespace app\admin\service;

use app\admin\model\User;
use think\Session;

class UserService
{
    /**
     * @desc 获取分页数据
     * @param $pageNo
     * @param $pageSize
     * @param $where
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList($pageNo, $pageSize, $where)
    {
        return User::where($where)->page($pageNo, $pageSize)->select();
    }

    /**
     * @desc 查询总数
     * @param array $where
     * @return int|string
     * @throws \think\Exception
     */
    public function getCount($where = [])
    {
        return User::where($where)->count();
    }

    public function login($userInfo)
    {
        Session::set('user_id', $userInfo->user_id);
        Session::set('username', $userInfo->username);

        //更新用户登录最后登录时间
        User::where('user_id', $userInfo->user_id)
            ->update(['last_login_time' => date('Y-m-d H:i:s')]);
    }
}