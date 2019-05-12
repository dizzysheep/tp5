<?php

namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require|unique:user|max:32',
        'name' => 'require|max:32',
        'password' => 'require|max:12',
        'sex' => 'require|in:1,2',
    ];

}