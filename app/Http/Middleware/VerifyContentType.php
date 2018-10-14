<?php

namespace App\Http\Middleware;

use Closure;

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
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isJson()) {
            return $next($request);
        }

        return failed('请求必须为JSON格式', 400);
    }
}
