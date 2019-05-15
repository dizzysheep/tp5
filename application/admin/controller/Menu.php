<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-14
 * Time: 16:41
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\constants\ErrorCode;
use app\Func;

class Menu extends Base
{
    /**
     * @var \app\admin\model\menu
     */
    protected $model;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('menu');
    }

    public function menuList()
    {

    }

    /**
     * @desc 添加菜单
     * @link /menu/menuAdd
     */
    public function menuAdd()
    {
        //参数校验
        $menuService = Func::loadService('menu');
        $data = $menuService->checkParams();

        //执行写入
        $return = $menuService->save($data);
        if ($return['code'] == ErrorCode::RET_SUCCESS) {
            successJson('添加菜单成功');
        } else {
            errorJson($return['code'], $return['msg']);
        }
    }

    /**
     * @desc 添加菜单
     * @link /menu/menuEdit
     */
    public function menuEdit()
    {
        $data = Func::loadService('menu')->checkParams('menu', 'edit');
        $data['menu_id'] = $this->request->param('menu_id', 0);

        $info = $this->model->find($data['menu_id']);
        if (empty($info)) {
            errorJson(ErrorCode::PARAM_INVALID, '菜单详情不存在');
        }

        //执行写入
        $flag = $this->model->update($data);
        if ($flag) {
            successJson('修改菜单成功');
        } else {
            errorJson(ErrorCode::DB_EXEC_FAIL, '修改菜单失败');
        }
    }
}