<?php

namespace app\constants;
class ErrorCode
{
    CONST RET_SUCCESS = 0;
    const RET_ERROR = 1;

    /**
     * @desc 系统错误 100-199
     */
    const RET_LOGIN_TIME_OUT = 100;
    const PARAM_INVALID = 101;
    const NO_AUTH = 102;

    /**
     * @desc 数据库错误 200-399
     */
    const DB_EXEC_FAIL = 200;
}