<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * 用户逻辑控制器
 *
 * Date: 2018/10/15
 * @author George
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function index(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'filled',
    		'email' => 'filled',
			'email_verified' => Rule::in(['all', 'unverified', 'verified'])
		]);

    	$query = User::query();

    	if ($name = $request->get('name')) {
    		$query->where('name', 'like', "%$name%");
		}

		if ($email = $request->get('email')) {
			$query->where('email', 'like', "%$email%");
		}

		$email_verified = $request->get('email_verified');

		switch ($email_verified) {
			case 'unverified':
				$query->whereNull('email_verified_at');
				break;
			case 'verified':
				$query->whereNotNull('email_verified_at');
				break;
			case 'all':
			default:
				break;
		}

		$users = $query->paginate($request->get('paginate'));
		return success($users);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
    	$attributes = $this->validate($request, [
    		'name' => 'string',
    		'email' => 'email|unique:users',
    		'password' => 'alpha_num|confirmed',
    		'avatar' => 'nullable'
		]);

    	$user = User::create($attributes);
    	return stored($user);
    }

	/**
	 * Display the specified resource.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show($id)
    {
    	$user = User::findOrFail($id);
    	return success($user);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @param User $user
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, User $user)
    {
		$attributes = $this->validate($request, [
			'name' => 'string',
			'avatar' => 'nullable'
		]);

		$user->update($attributes);
		return updated($user);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param User $user
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(User $user)
    {
    	$user->delete();
    	return deleted();
    }
}
