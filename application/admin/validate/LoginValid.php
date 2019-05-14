<?php

namespace app\admin\validate;


class LoginValid extends BaseValid
{
    protected $rule = [
        'username' => 'require|max:32',
        'password' => 'require|max:12',
    ];

    protected $message = [
        'username.require' => '用户名不能为空',
        'username.max' => '用户名最多不能超过32个字符',
        'password.require' => '密码不能为空',
        'password.max' => '用户名最多不能超过12个字符',
    ];
}
