<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use Illuminate\Http\Request;

/**
 * 项目运行环境逻辑控制器
 *
 * Date: 2019-02-03
 * @author George
 * @package App\Http\Controllers
 */
class EnvironmentController extends Controller
{
	/**
	 * 获取项目的运行环境信息
	 *
	 * Date: 2019-02-03
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function index(Request $request)
    {
    	$this->validate($request, [
    		'project_id' => 'required|numeric',
			'name' => 'nullable'
		]);

    	$query = Environment::query();

    	if ($name = $request->get('name')) {
    		$query->where('name', 'like', "%$name%");
		}

    	$environments = $query->where('project_id', $request->get('project_id'))->get();
    	return success($environments);
    }

	/**
	 * 创建运行环境配置
	 *
	 * Date: 2019-02-03
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
        	'name' => 'required|string',
        	'configuration' => 'required|array',
        	'project_id' => 'required|numeric'
		]);

        $environment = Environment::create($attributes);
        return stored($environment);
    }

	/**
	 * 获取运行环境详情
	 *
	 * Date: 2019-02-03
	 * @author George
	 * @param Environment $environment
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Environment $environment)
    {
    	return success($environment);
    }

	/**
	 * 更新运行环境信息
	 *
	 * Date: 2019-02-03
	 * @author George
	 * @param Request $request
	 * @param Environment $environment
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Environment $environment)
    {
		$attributes = $this->validate($request, [
			'name' => 'required|string',
			'configuration' => 'required|array',
		]);

		$environment->update($attributes);
		return updated($environment);
    }

	/**
	 * 删除运行环境信息
	 *
	 * Date: 2019-02-03
	 * @author George
	 * @param Environment $environment
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Environment $environment)
    {
        $environment->delete();
        return deleted();
    }
}
