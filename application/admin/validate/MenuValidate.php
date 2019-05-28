<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-14
 * Time: 19:27
 */

namespace app\admin\validate;


use app\common\validate\BaseValid;
use app\constants\Common;

class Menu extends BaseValid
{
    protected $rule = [
        'title' => 'require|maxLength:32',
        'url' => 'require|maxLength:64',
        'style_name' => 'alpha|maxLength:64',
        'is_show' => 'require|integer|in:' . Common::SWITCH_OPEN . ',' . Common::SWITCH_CLONE,
        'pid' => 'require|integer',
        'sort' => 'integer',
    ];


}