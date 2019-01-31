<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as InterfaceRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

	/**
	 * Date: 2019-01-31
	 * @author George
	 * @param Request $request
	 * @param InterfaceRequest $interfaceRequest
	 */
    public function update(Request $request, InterfaceRequest $interfaceRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
