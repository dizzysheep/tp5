<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-14
 * Time: 16:41
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\Func;

class Menu extends Base
{
    /**
     * @var \app\admin\model\menu
     */
    protected $model;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('menu');
    }

    public function menuList()
    {

    }

    public function menuAdd()
    {
        //参数校验
        $data = Func::loadService('user')->checkParams();

        $this->model->data($data);
    }
}