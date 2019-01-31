<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

/**
 * 个人信息逻辑控制器
 *
 * Date: 2019-01-31
 * @author George
 * @package App\Http\Controllers\Account
 */
class ProfileController extends Controller
{
	/**
	 * 获取个人信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request)
	{
		$user = $request->user();
		return success($user);
	}

	/**
	 * 修改头像
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function avatar(Request $request)
	{
		$this->validate($request, [
			'avatar' => 'file|mimes:jpeg,jpg,png,gif'
		]);
		$path = Storage::disk('public')->putFile('avatar', $request->file('avatar'));
		$host = config('app.url');
		$uri = Storage::url($path);
		return updated(sprintf("%s%s", $host, $uri));
	}

	/**
	 * 修改密码
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function password(Request $request)
	{
		$attributes = $this->validate($request, [
			'password' => 'alpha_num|confirmed'
		]);

		/**
		 * @var User $user
		 */
		$user = $request->user();
		$user->update($attributes);
		return message('修改成功');
	}
}
