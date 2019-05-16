<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-13
 * Time: 18:55
 */

namespace app\admin\model;


use app\admin\traits\SystemTimeTrait;
use app\admin\traits\UserTrait;
use app\common\model\BaseModel;

class GroupModel extends BaseModel
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