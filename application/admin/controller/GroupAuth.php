<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 11:40
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\constants\ErrorCode;
use app\Func;


class GroupAuth extends Base
{
    /**
     * @desc 用户组model
     * @var \app\admin\model\User
     */
    protected $model;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('group_auth');
    }

    public function list()
    {

    }

    /**
     * @desc 用户组权限添加
     * @link /group_auth/add
     */
    public function add()
    {
        //参数校验
        $groupAuthService = Func::loadService('group_auth');
        $data = $groupAuthService->checkParams();

        //执行写入
        $return = $groupAuthService->save($data);
        if ($return['code'] == ErrorCode::RET_SUCCESS) {
            successJson('添加权限成功');
        } else {
            errorJson($return['code'], $return['msg']);
        }
    }

    /**
     * @desc 修改用户组权限
     * @link /group_auth/edit
     */
    public function edit()
    {
        //参数校验
        $groupAuthService = Func::loadService('group_auth');
        $data = $groupAuthService->checkParams();

        //执行写入
        $return = $groupAuthService->update($data);
        if ($return['code'] == ErrorCode::RET_SUCCESS) {
            successJson('修改权限成功');
        } else {
            errorJson($return['code'], $return['msg']);
        }
    }
}