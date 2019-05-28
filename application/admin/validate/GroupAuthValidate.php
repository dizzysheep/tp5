<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 11:49
 */

namespace app\admin\validate;


use app\common\validate\BaseValid;

class GroupAuthValid extends BaseValid
{
    protected $rule = [
        'group_id' => 'require|positiveInt',
        'menu_id' => 'require',
    ];
}