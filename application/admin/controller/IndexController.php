<?php
/**
 * Created by PhpStorm.
 * UserValid: yangxiang
 * Date: 2019-05-13
 * Time: 17:52
 */

namespace app\admin\controller;


use app\common\controller\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        successJson('success', ['hello world']);
    }
}