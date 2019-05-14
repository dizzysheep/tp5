<?php

namespace app\constants;

class Common
{
    //默认页数
    const FIRST_PAGE = 1;

    //分页默认大小
    const PAGE_SIZE = 20;

    // 布尔true
    const BOOL_TRUE = 1;

    // 布尔false
    const BOOL_FALSE = 0;

    //开启
    const SWITCH_OPEN = 1;

    //关闭
    const SWITCH_CLONE = 2;

    //一次最多加载500条数据
    const ONCE_MAX_COUNT = 500;

    //男
    const SEX_MAN = 1;

    //女
    const SEX_WOMAN = 2;

    //性别展示
    const SEX_SHOW = [self::SEX_MAN => '男', self::SEX_WOMAN => '女'];
}