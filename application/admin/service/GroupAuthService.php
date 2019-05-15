<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 11:46
 */

namespace app\admin\service;


use app\constants\ErrorCode;
use Exception;

class GroupAuthService
{
    /**
     * @desc 权限
     * @var \app\admin\model\GroupAuth
     */
    protected $groupAuthModel;

    /**
     * @desc 自定义处理函数
     */
    public function __construct()
    {
        $this->groupAuthModel = model('group_auth');
    }

    /**
     * @desc 批量添加权限
     * @param $data
     * @return array
     * @throws Exception
     */
    public function save($data)
    {
        $return = $this->checkParams($data);
        if ($return['code'] != ErrorCode::RET_SUCCESS) {
            return $return;
        }

        $flag = $this->saveAuth($data);
        if ($flag) {
            successReturn('添加权限权限成功');
        } else {
            errorReturn(ErrorCode::DB_EXEC_FAIL, '添加权限权限失败');
        }
    }

    /**
     * @desc 更新权限（删除原来的权限，添加新的）
     * @param $data
     * @return array
     * @throws \think\exception\PDOException
     */
    public function update($data)
    {
        $return = $this->checkParams($data);
        if ($return['code'] != ErrorCode::RET_SUCCESS) {
            return $return;
        }

        $this->groupAuthModel->startTrans();
        try {
            $flag = $this->groupAuthModel->where('group_id', $data['group_id'])->delete();
            if (!$flag) {
                throw new Exception('删除旧权限失败');
            }

            $flag2 = $this->saveAuth($data);
            if (!$flag2) {
                throw new Exception('添加新的权限失败');
            }
            $this->groupAuthModel->commit();

            successReturn('更新权限成功');
        } catch (Exception $exp) {
            $this->groupAuthModel->rollback();
            errorReturn(ErrorCode::DB_EXEC_FAIL, $exp->getMessage());
        }

    }

    /**
     * @desc 保存存在
     * @param $data
     * @return array|false
     * @throws \Exception
     */
    protected function saveAuth($data)
    {
        $batchData = [];
        $menuIds = explode(",", $data['menu_id']);
        foreach ($menuIds as $menuId) {
            $temp['menu_id'] = $menuId;
            $temp['group_id'] = $data['group_id'];
            $batchData[] = $temp;
        }

        $flag = $this->groupAuthModel->saveAll($batchData);
        return $flag;
    }

    /**
     * @desc 判断参数是否为空
     * @param $data
     * @return array
     */
    protected function checkParams($data)
    {
        if (empty($data['group_id'])) {
            return errorReturn(ErrorCode::RET_ERROR, 'group_id参数不能为空');
        }

        if (empty($data['menu_id'])) {
            return errorReturn(ErrorCode::RET_ERROR, 'menu_id参数不能为空');
        }
    }
}