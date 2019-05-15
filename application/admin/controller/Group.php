<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-13
 * Time: 17:52
 */

namespace app\admin\controller;

use app\common\controller\Base;
use app\constants\Common;
use app\constants\ErrorCode;
use app\admin\model\Group as GroupModel;
use app\Func;

class Group extends Base
{
    /**
     * @desc 用户组model
     * @var \app\admin\model\Group
     */
    protected $model;

    /**
     * @desc 初始化函数
     * @return bool|void
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new GroupModel();
    }

    /**
     * @desc 用户组列表
     * @link /group/groupList
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function groupList()
    {
        $params = [];

        //分页信息
        $pageNo = $this->request->param('page_no', Common::FIRST_PAGE);
        $pageSize = $this->request->param('page_size', Common::PAGE_SIZE);

        $data['total'] = $this->model->getCount($params);
        if ($data['total'] > 0) {
            $data['item'] = $this->model->getList($pageNo, $pageSize, $params);
        }

        successJson('查询成功', $data);
    }

    /**
     * @desc 用户组添加
     * @link /group/groupAdd
     */
    public function groupAdd()
    {
        //参数校验
        $data = Func::loadService('group')->checkParams();

        //添加数据
        $flag = $this->model->save($data);
        if ($flag) {
            errorJson(ErrorCode::DB_EXEC_FAIL, '添加用户组成功');
        } else {
            successJson(ErrorCode::DB_EXEC_FAIL, '添加用户组失败');
        }
    }

    /**
     * @desc 用户组编辑
     * @link /group/groupEdit
     */
    public function groupEdit()
    {
        //参数校验
        $data = Func::loadService('group')->checkParams();

        //判断用户组是否存在
        $groupId = $this->request->param('group_id', 0);
        $info = $this->model->find($groupId);
        empty($info) && errorJson(ErrorCode::PARAM_INVALID, '用户组不存在');

        //添加数据
        $flag = $this->model->save($data, ['group_id' => $info->group_id]);
        if ($flag) {
            errorJson(ErrorCode::DB_EXEC_FAIL, '修改用户组成功');
        } else {
            successJson(ErrorCode::DB_EXEC_FAIL, '修改用户组失败');
        }
    }
}