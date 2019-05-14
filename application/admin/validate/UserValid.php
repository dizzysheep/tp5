<?php

namespace app\admin\validate;


class UserValid extends BaseValid
{
    protected $rule = [
        'username' => 'require|unique:user|max:32',
        'name' => 'require|max:32',
        'password' => 'require|max:12',
        'phone' => 'require|length:11|number',
        'sex' => 'require|in:1,2',
    ];

    protected $scene = [
        'edit' => ['name', 'sex'],
    ];
}