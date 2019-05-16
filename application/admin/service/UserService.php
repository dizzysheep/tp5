<?php

namespace app\admin\service;

use app\admin\model\UserModel;
use think\Session;

class UserService
{

    /**
     * @desc 登录处理
     * @param $userInfo
     */
    public function login($userInfo)
    {
        //写入session
        Session::set('user_id', $userInfo->user_id);
        Session::set('username', $userInfo->username);

        /*
         * @desc 写入权限
         */
        $dataList = $userInfo->groupAuth;
        $menuId = [];
        foreach ($dataList as $data) {
            $menuId[] = $data->menu_id;
        }
        $menuIds = implode(',', $menuId);
        Session::set('menu_ids', $menuIds);

        //更新用户登录最后登录时间
        UserModel::where('user_id', $userInfo->user_id)
            ->update(['last_login_time' => date('Y-m-d H:i:s')]);
    }
}