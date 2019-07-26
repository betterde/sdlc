<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * 验证请求是否为JSON数据格式
 *
 * Date: 2018/10/14
 * @author George
 * @package App\Http\Middleware
 */
class VerifyContentType
{
	/**
	 * 定义需要排除的路由
	 *
	 * @var array $except
	 * Date: 2019-01-31
	 * @author George
	 */
	protected $except = [
		'account/avatar',
		'auth/verify'
	];

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isJson() || in_array($request->path(), $this->except)) {
            return $next($request);
        }

        return failed('请求必须为JSON格式', 400);
    }
}
