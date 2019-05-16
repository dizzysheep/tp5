<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 11:43
 */

namespace app\admin\model;

use app\admin\traits\SystemTimeTrait;
use app\admin\traits\UserTrait;
use app\common\model\BaseModel;

class GroupAuthModel extends BaseModel
{
    use UserTrait;
    use SystemTimeTrait;

    /**
     * @desc 添加自动写入
     * @var array
     */
    protected $insert = ['create_user_id', 'create_time'];

    /**
     * @desc 自动写入创建时间
     * @return int
     */
    public function setCreateTimeAttr()
    {
        return time();
    }
}