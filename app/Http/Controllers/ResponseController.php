<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

/**
 * 接口响应参数
 *
 * Date: 2019-01-26
 * @author George
 * @package App\Http\Controllers
 */
class ResponseController extends Controller
{
	/**
	 * 获取接口响应信息
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

		$response = Response::with('headers', 'arguments')->where('interface_id', $request->get('interface_id'))->get();
		return success($response);
    }

	/**
	 * 创建接口响应内容
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
			'description' => 'nullable'
		]);

		$response = Response::create($attributes);
		return stored($response);
    }

	/**
	 * 获取接口响应详情
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show($id)
    {
    	$responses = Response::with('headers', 'arguments')->where('id', $id)->firstOrFail();
    	return success($responses);
    }

	/**
	 * 更新接口响应信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @param Response $response
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Response $response)
    {
		$attributes = $this->validate($request, [
			'name' => 'string',
			'description' => 'nullable'
		]);

		$response->update($attributes);
		return updated($response);
    }

	/**
	 * 删除接口响应信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Response $response
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Response $response)
    {
    	$response->delete();
    	return deleted();
    }
}
