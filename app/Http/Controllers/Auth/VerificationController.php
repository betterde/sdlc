<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
	 * Show the email verification notice.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request)
	{
		return $request->user()->hasVerifiedEmail()
			? redirect($this->redirectPath())
			: view('auth.verify');
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
	 * Resend the email verification notification.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function resend(Request $request)
	{
		if ($request->user()->hasVerifiedEmail()) {
			return redirect($this->redirectPath());
		}

		$request->user()->sendEmailVerificationNotification();

		return back()->with('resent', true);
	}
}
