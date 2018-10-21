<?php

namespace App\Http\Controllers;

use App\Models\Preferences;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

/**
 * 系统偏好设置控制器
 *
 * Date: 2018/10/21
 * @author George
 * @package App\Http\Controllers
 */
class PreferencesController extends Controller
{
	/**
	 * 获取系统偏好设置列表
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function index(Request $request)
    {
    	$query = Preferences::query();

    	if ($category = $request->get('category')) {
    		$query->where('category', $category);
		}

    	if ($description = $request->get('description')) {
    		$query->where('description', 'like', "%{$description}%");
		}

    	return success($query->get());
    }

	/**
	 * 创建系统偏好设置
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
    	$attributes = $this->validate($request, [
    		'name' => 'required|string|unique:preferences',
    		'description' => 'required|string',
    		'value' => 'required|string',
    		'options' => 'filled|array',
    		'type' => [
    			'required',
				Rule::in(['service', 'custom'])
			],
		]);

    	$attributes['creator'] = Auth::id();
		$preferences = Preferences::create($attributes);
    	return stored($preferences);
    }

	/**
	 * 获取设置详情
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Preferences $preferences
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Preferences $preferences)
    {
    	return success($preferences);
    }

	/**
	 * 更新系统偏好设置
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Request $request
	 * @param Preferences $preferences
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Preferences $preferences)
    {
    	$attributes = $this->validate($request, [
    		'value' => [
    			'required',
				'string',
				Rule::in($preferences->options)
			]
		]);

    	$preferences->update($attributes);
    	return updated($preferences);
    }

	/**
	 * 删除系统偏好设置
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Preferences $preferences
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Preferences $preferences)
    {
    	if ($preferences->type === 'preset') {
    		return failed('该设置项为系统预置无法删除', 403);
		}

		$preferences->delete();
    	return deleted();
    }
}
