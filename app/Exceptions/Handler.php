<?php

namespace App\Exceptions;

use App\Common\Err\ApiErrDesc;
use App\Http\Response\ResponseJson;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ResponseJson;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //api接口主动抛出的异常
        if ($exception instanceof ApiException) {
            $code = $exception->getCode();
            $msssage = $exception->getMessage();
        }
        else
        {
             // 暂时不处理非主动异常
            // 如果是纯接口系统可以放开此注释
            $code = $exception->getCode();
            if (!$code || $code<0)
            {
                $code = ApiErrDesc::UNKNOWN_ERR[0];
            }
            $msssage = $exception->getMessage() ? $exception->getMessage() : ApiErrDesc::UNKNOWN_ERR[1];
        }
        return $this->jsonData($code,$msssage);
    }
}
