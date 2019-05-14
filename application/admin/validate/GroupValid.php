<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-14
 * Time: 13:50
 */

namespace app\admin\validate;


class GroupValid extends BaseValid
{
    protected $rule = [
        'group_name' => 'require',
    ];

}