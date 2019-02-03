<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

/**
 * 用户注册逻辑控制器
 *
 * Date: 2019-02-01
 * @author George
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	/**
	 * 用户注册
	 *
	 * Date: 2019-02-01
	 * @author George
	 * @param Request $request
	 * @return mixed
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function register(Request $request)
	{
		$attributes = $this->validate($request, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);

		event(new Registered($user = $this->create($attributes)));

		return success([
			'id' => $user->id,
			'name' => $user->name,
			'email' => $user->email,
			'avatar' => $user->avatar,
			'access_token' => Auth::login($user),
			'token_type' => 'Bearer',
			'expires_in' => config('jwt.ttl') * 60,
		]);
	}

	/**
	 * 创建用户
	 *
	 * Date: 2019-02-01
	 * @author George
	 * @param array $attributes
	 * @return User|\Illuminate\Database\Eloquent\Model
	 */
    protected function create(array $attributes)
    {
        return User::create($attributes);
    }
}
