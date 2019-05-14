<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-13
 * Time: 17:52
 */

namespace app\admin\controller;

use app\common\controller\Base;
use app\constants\ErrorCode;
use app\admin\model\Group as GroupModel;
use app\Func;

class Group extends Base
{
    /**
     * @desc 用户组列表
     */
    public function groupList()
    {
        $params = [];

    }

    /**
     * @desc 用户组列表
     * @link /group/groupAdd
     */
    public function groupAdd()
    {
        //数据校验
        $groupName = $this->request->param('group_name');
        if (empty($groupName)) {
            errorJson(ErrorCode::PARAM_INVALID, '请输入用户组名');
        }

        //添加数据
        $groupModel = new GroupModel();
        $groupModel->group_name = $groupName;
        $flag = $groupModel->save();
        if ($flag) {
            errorJson(ErrorCode::DB_EXEC_FAIL, '添加用户组成功');
        } else {
            successJson(ErrorCode::DB_EXEC_FAIL, '添加用户组失败');
        }
    }
}