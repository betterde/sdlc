<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Http\Request;

/**
 * 项目版本逻辑控制器
 *
 * Date: 2018/10/18
 * @author George
 * @package App\Http\Controllers
 */
class VersionController extends Controller
{
	/**
	 * 获取版本信息
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function index(Request $request)
    {
    	$this->validate($request, [
    		'project_id' => 'required|integer',
		]);

    	$versions = Version::query()
			->where('project_id', $request->project_id)
			->get();
    	return success($versions);
    }

	/**
	 * 创建项目版本
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
        	'project_id' => 'required|integer',
        	'number' => 'required|string',
        	'description' => 'filled|string'
		]);

        $version = Version::create($attributes);
        return stored($version);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

	/**
	 * 更新资源
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Request $request
	 * @param Version $version
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Version $version)
    {
		$attributes = $this->validate($request, [
			'number' => 'required|string',
			'description' => 'filled|string'
		]);

		$version->update($attributes);
		return updated($version);
    }

	/**
	 * 删除项目版本
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Version $version
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Version $version)
    {
    	$version->delete();
    	return deleted();
    }
}
