<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-14
 * Time: 09:44
 */

namespace app\admin\service;


use app\constants\ErrorCode;
use app\constants\System;
use app\Func;
use think\Loader;
use think\Request;

class BaseService
{
    /**
     * @desc 验证名称
     * @var $validName
     */
    protected $validName;

    /**
     * @desc 初始化代码
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->init();
        $this->setValidName();
    }

    /**
     * @desc 自定义处理函数
     */
    public function init()
    {

    }

    protected function setValidName()
    {
        $this->validName = Func::getClassName($this, 'service');
    }

    /**
     * @desc 数据验证方法
     * @param string $validName
     * @param string $scene
     * @return array
     */
    public function checkParams($validName = '', $scene = '')
    {
        if (!$validName) {
            $validName = $this->validName;
        }

        //获取验证参数
        $data = Request::instance()->param();

        //数据校验
        $validate = Loader::validate($validName . System::VALID_SUFFIX);
        $validate->scene($scene);
        if (!$validate->check($data)) {
            errorJson(ErrorCode::PARAM_INVALID, $validate->getError());
        }

        //过滤无用参数
        $rule = $scene ? $validate->getSceneField($scene) : $validate->getRuleField();
        $data = array_intersect_key($data, $rule);

        return $data;
    }


}