<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * 验证用户邮箱
 *
 * Date: 2019-02-03
 * @author George
 * @package App\Http\Controllers\Auth
 */
class VerificationController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

	/**
	 * 验证用户邮箱
	 *
	 * Date: 2019-02-03
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws AuthorizationException
	 */
	public function verify(Request $request)
	{
		if ($request->route('id') != $request->user()->getKey()) {
			throw new AuthorizationException;
		}

		if ($request->user()->hasVerifiedEmail()) {
			return message('账户已经验证通过，请勿重复验证');
		}

		if ($request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}

		return message('验证成功');
	}

	/**
	 * 从新发送验证邮件
	 *
	 * Date: 2019-02-03
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function resend(Request $request)
	{
		/**
		 * @var User $user
		 */
		$user = $request->user();

		if ($user->hasVerifiedEmail()) {
			return message('账户已经验证通过，请勿重复验证');
		}

		$user->sendEmailVerificationNotification();

		return message(sprintf('已发送到%s', $user->email));
	}
}
