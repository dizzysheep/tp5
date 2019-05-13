<?php

namespace app\admin\controller;

use app\admin\service\UserService;
use app\common\controller\Base;
use app\constants\ErrorCode;
use think\Request;
use \app\admin\model\User as UserModel;

class User extends Base
{
    /**
     * @desc 查询类标数据
     * @link /admin/user/userList
     * @param Request $request
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function userList(Request $request)
    {
        $params = [];

        //分页信息
        $pageNo = $request->param('page_no');
        $pageSize = $request->param('page_size');

        $userService = new UserService();
        $data['total'] = $userService->getCount($params);
        if ($data['total'] > 0) {
            $data['item'] = (new UserService())->getList($pageNo, $pageSize, $params);
        }

        return $this->successJson('查询成功', $data);
    }

    /**
     * @desc 用户添加
     * @link /admin/user/userAdd
     * @param Request $request
     */
    public function userAdd(Request $request)
    {
        $data['name'] = $request->param('name');
        $data['username'] = $request->param('username');
        $data['password'] = $request->param('password');
        $data['phone'] = $request->param('phone');
        $data['sex'] = $request->param('sex');

        //参数校验
        $result = $this->validate($data, '\app\admin\validate\UserValid');
        if ($result !== true) {
            $this->errorJson(ErrorCode::PARAM_INVALID, $result);
        }

        //执行写入
        $userModel = new UserModel();
        $userModel->data($data, true);
        $flag = $userModel->save();
        if ($flag) {
            $this->successJson('添加用户成功');
        } else {
            $this->errorJson(ErrorCode::PARAM_INVALID, '添加用户失败');
        }
    }

    /**
     * @desc 用户编辑
     * @link /admin/user/userEdit
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function userEdit(Request $request)
    {
        $data['name'] = $request->param('name');
        $data['sex'] = $request->param('sex');
        $id = $request->param('id');

        //参数校验
        $result = $this->validate($data, '\app\admin\validate\UserValid.edit');
        if ($result !== true) {
            $this->errorJson(ErrorCode::PARAM_INVALID, $result);
        }

        $user = UserModel::get($id);
        if (empty($user)) {
            $this->errorJson(ErrorCode::PARAM_INVALID, '用户信息不存在');
        }

        //执行写入
        $userModel = new UserModel();
        $flag = $userModel->save($data, ['user_id' => $id]);
        if ($flag) {
            $this->successJson('添加用户成功');
        } else {
            $this->errorJson(ErrorCode::PARAM_INVALID, '修改数据成功');
        }
    }
}