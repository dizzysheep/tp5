<?php

namespace app\admin\controller;

use app\common\controller\Base;

class Index extends Base
{
    public function index()
    {
        $this->successJson('success', ['hello world']);
    }
}
