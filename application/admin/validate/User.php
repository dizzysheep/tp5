<?php

namespace app\admin\validate;


use app\common\validate\BaseValid;
use app\constants\Common;

class User extends BaseValid
{
    protected $rule = [
        'username' => 'require|alphaDash|unique:user|maxLength:32',
        'name' => 'require|maxLength:32',
        'password' => 'require|alphaDash',
        'phone' => 'require|length:11|number',
        'sex' => 'require|integer|in:' . Common::SWITCH_OPEN . ',' . Common::SWITCH_CLONE,
        'status' => 'require|integer|in:' . Common::SWITCH_OPEN . ',' . Common::SWITCH_CLONE,
        'group_id' => 'require|positiveInt',
    ];

    protected $scene = [
        'edit' => ['name', 'sex'],
        'switch_status' => ['status'],
    ];
}
