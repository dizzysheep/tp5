<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-13
 * Time: 18:55
 */

namespace app\admin\model;


use app\admin\traits\SystemTimeTrait;
use app\admin\traits\UserTrait;
use think\Model;

class Group extends Model
{
    use UserTrait;
    use SystemTimeTrait;

    /**
     * @desc 主键
     * @var string
     */
    protected $pk = 'group_id';

    /**
     * @desc 自动写入时间戳
     * @var bool
     */
    protected $autoWriteTimestamp = true;

    /**
     * @desc 添加自动写入
     * @var array
     */
    protected $insert = ['create_user_id'];

    /**
     * @desc 修改
     * @var array
     */
    protected $update = ['update_user_id'];


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

}