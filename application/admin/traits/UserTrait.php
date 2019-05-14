<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-14
 * Time: 11:22
 */

namespace app\admin\traits;


use app\admin\model\User as UserModel;
use think\Session;

trait UserTrait
{
    /**
     * @desc 创建人展示
     * @param $value
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCreateUSerAttr($value)
    {
        return $this->_getUserName($value);
    }

    /**
     * @desc 修改人展示
     * @param $value
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUpdateUSerAttr($value)
    {
        return $this->_getUserName($value);
    }

    /**
     * @param $value
     * @return bool|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function _getUserName($value)
    {
        if (empty($value)) {
            return '系统';
        }

        $userInfo = UserModel::find($value);
        return $userInfo->name;
    }


}