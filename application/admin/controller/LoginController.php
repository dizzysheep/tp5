<?php

namespace app\admin\controller;

use app\common\controller\BaseController;
use app\constants\ErrorCode;
use app\Func;
use think\Request;
use think\Session;

class LoginController extends BaseController
{
    protected $checkLogin = false;

    /**
     * @desc 登录成功
     * @param Request $request
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index(Request $request)
    {
        $data['username'] = $request->param('username');
        $data['password'] = $request->param('password');

        //数据验证
        $result = $this->validate($data, 'app\admin\validate\LoginValid');
        if ($result !== true) {
            errorJson(ErrorCode::PARAM_INVALID, $result);
        }

        //查询用户信息
        $userInfo = model('user')->where('username', $data['username'])->find();
        if (empty($userInfo)) {
            errorJson(ErrorCode::PARAM_INVALID, '用户信息不存在');
        }

        //判断密码是否正确
        if (!password_verify($data['password'], $userInfo->password)) {
            errorJson(ErrorCode::PARAM_INVALID, '账号或密码错误');
        }

        //登录逻辑处理
        service('user')->login($userInfo);

        successJson('登录成功');
    }

    /**
     * @desc 登出
     */
    public function loginOut()
    {
        Session::delete('user_id');
        Session::delete('user_id');
        successJson('退出成功');
    }
}