<?php

namespace app\admin\validate;


use app\common\validate\BaseValid;

class UserValid extends BaseValid
{
    protected $rule = [
        'username' => 'require|alphaDash|unique:user|max:32',
        'name' => 'require|max:32',
        'password' => 'require|max:12',
        'phone' => 'require|length:11|number',
        'sex' => 'require|in:1,2',
        'group_id' => 'require|positiveInt',
    ];

    protected $scene = [
        'edit' => ['name', 'sex'],
    ];
}