<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-15
 * Time: 09:53
 */

namespace app\admin\service;


use app\admin\model\Menu;
use app\admin\model\MenuModel;
use app\constants\ErrorCode;
use Exception;

class MenuService
{
    /**
     * @desc 添加菜单
     * @param $data
     * @return array
     * @throws \think\exception\PDOException
     */
    public function save($data)
    {
        // 启动事务
        $menuModel = new MenuModel();
        $menuModel->startTrans();

        try {
            //写入
            $flag = $menuModel->insertOne($data);
            if (!$flag) {
                throw new Exception("写入menu数据失败," . $menuModel->getError());
            }

            //更新
            $flag2 = $menuModel->update([
                'menu_id' => $menuModel->menu_id,
                'sort' => $menuModel->menu_id,
            ]);
            if (!$flag2) {
                throw new Exception("更新menu表的sort字段失败," . $menuModel->getError());
            }

            $menuModel->commit();
            return successReturn('添加菜单成功');
        } catch (Exception $exp) {
            $menuModel->rollback();
            return errorReturn(ErrorCode::DB_EXEC_FAIL, $exp->getMessage());
        }

    }
}