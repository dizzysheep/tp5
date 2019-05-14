<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-13
 * Time: 19:18
 */

namespace app\admin\service;


use app\admin\model\Group as GroupModel;
use app\common\service\BaseService;

class GroupService extends BaseService
{
    /**
     * @desc 获取分页数据
     * @param $pageNo
     * @param $pageSize
     * @param array $params
     * @return mixed
     */
    public function getList($pageNo, $pageSize, $params = [])
    {
        return $this->buildWhere($params)->page($pageNo, $pageSize)->select();
    }

    /**
     * @desc 查询总数
     * @param array $params
     * @return mixed
     */
    public function getCount($params = [])
    {
        return $this->buildWhere($params)->count();
    }

    /**
     * @desc 处理搜索条件
     * @param $params
     * @return mixed
     */
    protected function buildWhere($params)
    {
        $group = new GroupModel();
        $group->where($params);

        return $group;
    }
}