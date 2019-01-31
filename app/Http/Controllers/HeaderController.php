<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * 接口头信息逻辑控制器
 *
 * Date: 2019-01-31
 * @author George
 * @package App\Http\Controllers
 */
class HeaderController extends Controller
{
	/**
	 * 获取头信息列表
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
    		'scene_id' => 'numeric',
    		'scene_type' => Rule::in(['request', 'response']),
		]);

    	$headers = Header::where('scene_id', $request->get('scene_id'))
			->where('scene_type', $request->get('scene_type'))
			->get();
    	return success($headers);
    }

	/**
	 * 创建头信息
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
    		'value' => 'string',
    		'description' => 'nullable',
    		'scene_id' => 'numeric',
    		'scene_type' => 'string',
		]);

    	$header = Header::create($attributes);
    	return stored($header);
    }

	/**
	 * 获取头详情信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Header $header
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Header $header)
    {
    	return success($header);
    }

	/**
	 * 更信头信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @param Header $header
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Header $header)
    {
		$attributes = $this->validate($request, [
			'name' => 'string',
			'value' => 'string',
			'description' => 'nullable',
			'scene_id' => 'numeric',
			'scene_type' => 'string',
		]);

		$header->update($attributes);
		return updated($header);
    }

	/**
	 * 删除头信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Header $header
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Header $header)
    {
    	$header->delete();
    	return deleted();
    }
}
