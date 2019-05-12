<?php

namespace app\constants;
class ErrorCode
{
    CONST RET_SUCCESS = 0;
    const RET_ERROR = 1;

    /**
     * @desc 系统错误
     */
    const RET_LOGIN_TIME_OUT = 100;
    const PARAM_INVALID = 101;
}