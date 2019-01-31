<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as InterfaceRequest;

/**
 * 接口请求逻辑控制器
 *
 * Date: 2019-01-31
 * @author George
 * @package App\Http\Controllers
 */
class RequestController extends Controller
{
	/**
	 * 获取接口请求信息
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

    	$requests = InterfaceRequest::with('headers', 'arguments')->where('interface_id', $request->get('interface_id'))->get();
    	return success($requests);
    }

	/**
	 * 创建接口请求实例
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

        $request = InterfaceRequest::create($attributes);
        return stored($request);
    }

	/**
	 * 获取接口请求信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show($id)
    {
    	$request = InterfaceRequest::with('headers', 'arguments')->where('id', $id)->firstOrFail();
    	return success($request);
    }

	/**
	 * 更新接口请求信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @param InterfaceRequest $interfaceRequest
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, InterfaceRequest $interfaceRequest)
    {
		$attributes = $this->validate($request, [
			'name' => 'string',
			'description' => 'nullable'
		]);

		$interfaceRequest->update($attributes);
		return updated($interfaceRequest);
    }

	/**
	 * 删除接口请求信息
	 *
	 * Date: 2019-01-31
	 * @author George
	 * @param InterfaceRequest $interfaceRequest
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(InterfaceRequest $interfaceRequest)
    {
    	$interfaceRequest->delete();
    	return deleted();
    }
}
