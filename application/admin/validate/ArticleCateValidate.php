<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 14:59
 */

namespace app\admin\validate;


use app\common\validate\BaseValid;
use app\constants\Common;

class ArticleCateValidate extends BaseValid
{
    protected $rule = [
        'cate_name' => 'require|maxLength:64',
        'is_show' => 'require|integer|in:' . Common::SWITCH_OPEN . ',' . Common::SWITCH_CLONE,
        'pid' => 'require|integer',
        'sort' => 'require|integer',
    ];
}