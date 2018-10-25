<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

/**
 * 项目模块逻辑控制器
 *
 * Date: 2018/10/25
 * @author George
 * @package App\Http\Controllers
 */
class ModuleController extends Controller
{
	/**
	 * 获取项目模块列表
	 *
	 * Date: 2018/10/25
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

		$query = Module::query()->where('project_id', $request->project_id);

		if ($name = $request->get('name')) {
			$query->where('name', 'like', "%{$name}%");
		}

		return success($query->paginate($request->get('paginate')));
    }

	/**
	 * 创建项目模块
	 *
	 * Date: 2018/10/25
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
    	$attributes = $this->validate($request, [
    		'name' => 'required|string',
    		'project_id' => 'required|integer',
    		'version_id' => 'filled|integer',
    		'principal' => 'filled|integer'
		]);

    	$module = Module::create($attributes);

    	return stored($module);
    }

	/**
	 * 获取模块详情
	 *
	 * Date: 2018/10/25
	 * @author George
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Module $module)
    {
    	return success($module);
    }

	/**
	 * 更新模块信息
	 *
	 * Date: 2018/10/25
	 * @author George
	 * @param Request $request
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Module $module)
    {
		$attributes = $this->validate($request, [
			'name' => 'filled|string',
			'version_id' => 'filled|integer',
			'principal' => 'filled|integer'
		]);

		$module->update($attributes);

		return updated($module);
    }

	/**
	 * 删除模块
	 *
	 * Date: 2018/10/25
	 * @author George
	 * @param Module $module
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Module $module)
    {
        $module->delete();
        return deleted();
    }
}
