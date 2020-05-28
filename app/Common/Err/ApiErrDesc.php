<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/27
 * Time: 13:37
 */
namespace App\Common\Err;
class ApiErrDesc
{
    /**
     * API通用错误码
     */
    const SUCCESS = [0,'Success'];
    const ERR_PARAMS = [1,'参数错误'];
    const UNKNOWN_ERR = [2,'未知错误'];
    const ERR_URL = [3,'访问接口不存在'];
    const TOKEN_ERR = [4,'TOKEN错误'];
    const NO_TOKEN_ERR = [5,'TOKEN不存在'];
    const USER_NOT_EXIST = [6,'用户不存在'];
}