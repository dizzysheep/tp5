<?php
/**
 * Created by PhpStorm.
 * User: yangxiang
 * Date: 2019-05-15
 * Time: 14:43
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\constants\ErrorCode;

class ArticleCate extends Base
{
    public function list()
    {

    }

    /**
     * @desc 添加文章分类
     * @link /article_cate/add
     */
    public function add()
    {
        $data = $this->request->param();
        $flag = model('article_cate')->validate(true)->allowField(true)->save($data);

        if ($flag) {
            successJson('添加文章分类成功');
        } else {
            errorJson(ErrorCode::DB_EXEC_FAIL, '添加文章分类失败');
        }
    }

    /**
     * @desc 添加文章分类
     * @link /article_cate/add
     */
    public function edit()
    {

    }
}