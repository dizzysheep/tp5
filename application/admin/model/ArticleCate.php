<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 14:51
 */

namespace app\admin\model;

use app\admin\traits\SystemTimeTrait;
use app\admin\traits\UserTrait;
use think\Model;

class ArticleCate extends Model
{
    use UserTrait;
    use SystemTimeTrait;

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



}