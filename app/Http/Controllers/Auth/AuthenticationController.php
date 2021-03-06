<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tymon\JWTAuth\JWTGuard;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Auth\EloquentUserProvider;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * 用户认证逻辑控制器
 *
 * Date: 2018/9/9
 * @author George
 * @package App\Http\Controllers\Auth
 */
class AuthenticationController extends Controller
{
    use AuthenticatesUsers;

    /**
     * AuthenticationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:users', ['except' => ['signin']]);
    }

	/**
	 * 用户登陆逻辑
	 *
	 * Date: 2018/10/15
	 * @author George
	 * @param Request $request
	 * @param Hasher $hasher
	 * @return JsonResponse
	 * @throws ValidationException
	 */
    public function signin(Request $request, Hasher $hasher)
    {
        $credentials = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => '请输入您的账户',
            'password.required' => '请输入您的密码',
        ]);

        $credentials[$this->username()] = Arr::pull($credentials, 'username');
        $provider = new EloquentUserProvider($hasher, User::class);

        /**
         * 根据用户凭证获取用户信息
         *
         * @var User $user
         */
        $user = $provider->retrieveByCredentials($credentials);

        if ($user && $provider->validateCredentials($user, $credentials)) {
            try {
                if (!$token = $this->guard()->login($user)) {
                    return failed('认证失败，用户名或密码不正确', 401);
                }
            } catch (JWTException $exception) {
                return internalError();
            }

            return success([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => config('jwt.ttl') * 60,
            ]);
        }

        return failed('认证失败，用户名或密码不正确', 401);
    }

    /**
     * 注销登陆
     *
     * Date: 2018/10/14
     * @author George
     * @return JsonResponse
     */
    public function signout()
    {
        $this->guard()->logout();
        return message('注销成功');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * 获取用户凭证字段
     *
     * Date: 2018/9/9
     * @author George
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * 获取Guard实例
     *
     * Date: 2018/10/14
     * @author George
     * @return JWTGuard
     */
    protected function guard()
    {
        return Auth::guard('users');
    }
}
