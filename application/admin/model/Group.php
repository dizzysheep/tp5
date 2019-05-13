<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-13
 * Time: 18:55
 */

namespace app\admin\model;


use think\Model;

class Group extends Model
{

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


}