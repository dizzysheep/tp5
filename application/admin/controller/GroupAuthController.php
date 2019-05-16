<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 11:40
 */

namespace app\admin\controller;


use app\common\controller\BaseController;
use app\constants\ErrorCode;
use app\Func;


class GroupAuthController extends BaseController
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
        //获取参数
        $data = $this->request->param();

        //执行写入
        $return = service('group_auth')->save($data);
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
        //获取参数
        $data = $this->request->param();

        //执行写入
        $return = service('group_auth')->update($data);
        if ($return['code'] == ErrorCode::RET_SUCCESS) {
            successJson('修改权限成功');
        } else {
            errorJson($return['code'], $return['msg']);
        }
    }
}