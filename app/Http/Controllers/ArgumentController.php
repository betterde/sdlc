<?php

namespace App\Http\Controllers;

use App\Models\Argument;
use Illuminate\Http\Request;

/**
 * 接口参数逻辑控制器
 *
 * Date: 2019-01-31
 * @author George
 * @package App\Http\Controllers
 */
class ArgumentController extends Controller
{
	/**
	 * 获取接口参数列表
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
    		'interface_id' => 'numeric'
		]);

    	$arguments = Argument::where('interface_id', $request->get('interface_id'))->get();
    	return success($arguments->keyBy('scene_type'));
    }

	/**
	 * 创建接口参数
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
        	'interface_id' => 'numeric',
        	'name' => 'string',
        	'type' => 'string',
        	'description' => 'nullable|string',
        	'value' => 'string',
        	'options' => 'array',
        	'regulation' => 'string',
        	'scene_id' => 'numeric',
        	'scene_type' => 'string'
		]);

        $argument = Argument::create($attributes);
        return success($argument);
    }

	/**
	 * 获取接口参数详情信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Argument $argument
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Argument $argument)
    {
    	return success($argument);
    }

	/**
	 * 更新接口参数详情信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @param Argument $argument
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Argument $argument)
    {
		$attributes = $this->validate($request, [
			'name' => 'string',
			'type' => 'string',
			'description' => 'nullable|string',
			'value' => 'string',
			'options' => 'array',
			'regulation' => 'string'
		]);

		$argument->update($attributes);
		return updated($attributes);
    }

	/**
	 * 删除接口参数
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Argument $argument
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Argument $argument)
    {
    	$argument->delete();
    	return deleted();
    }
}
