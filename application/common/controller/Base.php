<?php

namespace app\common\controller;

use app\admin\model\User;
use app\constants\ErrorCode;
use app\Func;
use think\Controller;
use think\Session;

class Base extends Controller
{
    /**
     * @desc 是否需要登录
     * @var bool
     */
    protected $checkLogin = true;

    /**
     * @desc 登录白名单
     * @var array
     */
    protected $noCheckLogin = [];

    /**
     * @desc 登录信息
     * @var array
     */
    public $userInfo = [];

    /**
     * @desc 用户id
     * @var int
     */
    public $userId = 0;

    /**
     * @desc 初始化处理数据
     */
    protected function _initialize()
    {
        parent::_initialize();

        //免登录
        if (!$this->checkLogin || in_array($this->request->action, $this->noCheckLogin)) {
            return true;
        }

        //登录检验
        $this->_checkLogin();

        //权限验证
        $this->__hasAuth();

        return true;
    }

    /**
     * @desc
     * 1.检查是否登录
     * 2.将用户信息放置成员属性中
     */
    private function _checkLogin()
    {
        if (!Session::get('user_id')) {
            $this->errorJson(ErrorCode::RET_LOGIN_TIME_OUT, '登录超时');
        }
        $this->userId = Session::get('user_id');

        //查询用户信息
        $this->userInfo = User::get($this->userId);
    }

    /**
     * @desc 权限验证
     */
    private function __hasAuth()
    {

    }


}