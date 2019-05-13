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
     * @param array $params
     * @return mixed
     */
    public function getList($pageNo, $pageSize, $params = [])
    {
        return $this->buildWhere($params)->page($pageNo, $pageSize)->select();
    }

    /**
     * @desc 查询总数
     * @param array $params
     * @return mixed
     */
    public function getCount($params = [])
    {
        return $this->buildWhere($params)->count();
    }

    /**
     * @desc 处理搜索条件
     * @param $params
     * @return mixed
     */
    protected function buildWhere($params)
    {
        $user = new User();

        //search_key参数需要特殊处理
        if ($params['search_key']) {
            $user->whereOr([
                'phone' => $params['search_key'],
                'username' => ['like', "%" . $params['search_key'] . "%"],
                'name' => ['like', "%" . $params['search_key'] . "%"],
            ]);
        }

        return $user;
    }

    /**
     * @desc 登录处理
     * @param $userInfo
     */
    public function login($userInfo)
    {
        Session::set('user_id', $userInfo->user_id);
        Session::set('username', $userInfo->username);

        //更新用户登录最后登录时间
        User::where('user_id', $userInfo->user_id)
            ->update(['last_login_time' => date('Y-m-d H:i:s')]);
    }
}