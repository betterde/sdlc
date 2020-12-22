<?php

namespace App\Exceptions;

use Throwable;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * 全局异常处理
 *
 * Date: 2018-12-24
 * @author George
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
	protected $dontReport = [
		HttpException::class,
		ValidationException::class,
		ModelNotFoundException::class,
		AuthorizationException::class,
		AuthenticationException::class
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
	 * Date: 2018/10/14
	 * @param Throwable $exception
	 * @return mixed|void
	 * @throws Exception
	 * @author George
	 */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param Request $request
	 * @param Throwable $exception
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws Throwable
	 */
    public function render($request, Throwable $exception)
    {
    	if ($exception instanceof ValidationException) {
			return failed(Arr::first(Arr::collapse($exception->errors())), 422);
		}

    	if ($exception instanceof ModelNotFoundException) {
    	    return notFound();
        }

    	if ($exception instanceof NotFoundHttpException) {
    	    return notFound();
        }

    	if ($exception instanceof ThrottleRequestsException) {
    		return failed("请求过于频繁", 400);
		}

        return parent::render($request, $exception);
    }

    /**
     * 认证失败后处理逻辑
     *
     * Date: 2018/10/14
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse|Response
     *@author George
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return failed('认证失败请重新登陆', 401);
    }
}
