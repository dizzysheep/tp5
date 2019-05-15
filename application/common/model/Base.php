<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 15:17
 */

namespace app\common\model;


use think\Model;

class Base extends Model
{
    /**
     * @desc 获取分页数据
     * @param $pageNo
     * @param $pageSize
     * @param array $params
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList($pageNo, $pageSize, $params = [])
    {
        $where = $this->buildWhere($params);
        return $this->where($where)->page($pageNo, $pageSize)->select();
    }

    /**
     * @desc 查询总数
     * @param array $params
     * @return int|string
     * @throws \think\Exception
     */
    public function getCount($params = [])
    {
        $where = $this->buildWhere($params);
        return $this->where($where)->count();
    }

    /**
     * @desc 处理搜索条件
     * @param $params array
     * @return mixed
     */
    protected function buildWhere(array $params)
    {
        $where = " 1 = 1 ";


        return $where;
    }

    /**
     * @desc 写入单条数据|并且使用验证
     * @param array $data
     * @param string $validName
     * @return false|int
     */
    public function insertOne(array $data, $validName = '')
    {
        return $this->validate($validName ?: true)->allowField(true)->save($data);
    }

    /**
     * @desc 更新单条数据
     * @param int $id
     * @param array $data
     * @param $validName
     * @return false|int
     */
    public function updateOne(int $id, array $data, $validName = '')
    {
        return $this->validate($validName ?: true)->allowField(true)->save($data, [$this->pk => $id]);
    }
}