<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-14
 * Time: 13:50
 */

namespace app\admin\validate;


use app\common\validate\BaseValid;

class Group extends BaseValid
{
    protected $rule = [
        'group_name' => 'require',
    ];

}