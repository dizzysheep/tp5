<?php

namespace app\admin\controller;

use app\admin\service\UserService;
use app\common\controller\Base;
use app\constants\Common;
use app\constants\ErrorCode;
use think\Request;
use \app\admin\model\User as UserModel;

class User extends Base
{
    /**
     * @desc 查询类标数据
     * @link /user/userList
     * @param Request $request
     */
    public function userList(Request $request)
    {
        //用户搜索条件处理
        $params['search_key'] = $request->param('search_key');

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
     * @link /user/userAdd
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
     * @link /user/userEdit
     * @param Request $request
     * @throws \think\exception\DbException
     */
    public function userEdit(Request $request)
    {
        $data['name'] = $request->param('name');
        $data['sex'] = $request->param('sex');
        $userId = $request->param('user_id');

        //参数校验
        $result = $this->validate($data, '\app\admin\validate\UserValid.edit');
        if ($result !== true) {
            $this->errorJson(ErrorCode::PARAM_INVALID, $result);
        }

        //用户信息处理
        $user = $this->_userInfoExist($userId);

        //执行写入
        $userModel = new UserModel();
        $flag = $userModel->save($data, ['user_id' => $user->user_id]);
        if ($flag) {
            $this->successJson('修改用户信息成功');
        } else {
            $this->errorJson(ErrorCode::PARAM_INVALID, '修改用户信息失败');
        }
    }

    /**
     * @desc 用户状态切换
     * @link /user/statusSwitch
     * @throws \think\exception\DbException
     */
    public function statusSwitch()
    {
        //参数校验
        $status = $this->request->param('status');
        $userId = $this->request->param('user_id');
        if (!in_array($status, [Common::SWITCH_OPEN, Common::SWITCH_CLONE])) {
            $this->errorJson(ErrorCode::PARAM_INVALID, '参数不合法');
        }

        //用户信息处理
        $user = $this->_userInfoExist($userId);

        //重复操作
        if ($user->status == $status) {
            $this->errorJson(ErrorCode::PARAM_INVALID, '重复操作');
        }

        //更新数据
        $flag = UserModel::where('user_id', $userId)
            ->update(['status' => $status]);
        if ($flag) {
            $this->successJson('用户状态修改成功');
        } else {
            $this->errorJson(ErrorCode::PARAM_INVALID, '用户状态修改失败');
        }
    }

    /**
     * @desc 用户删除
     * @link /user/userDel
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function userDel()
    {
        $userId = $this->request->param('user_id');
        $user = $this->_userInfoExist($userId);

        //删除数据
        $flag = $user->delete();
        if ($flag) {
            $this->successJson('删除用户成功');
        } else {
            $this->errorJson(ErrorCode::PARAM_INVALID, '删除用户失败');
        }
    }

    /**
     * @desc 验证用户信息是否存在
     * @param $userId
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function _userInfoExist($userId)
    {
        if (empty($userId)) {
            $this->errorJson(ErrorCode::PARAM_INVALID, 'user_id参数不合法');
        }

        //用户信息查询
        $user = UserModel::find($userId);
        if (empty($user)) {
            $this->errorJson(ErrorCode::PARAM_INVALID, '用户信息不存在');
        }

        return $user;
    }

}