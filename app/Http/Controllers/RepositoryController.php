<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * 项目仓库逻辑控制器
 *
 * Date: 2018/10/18
 * @author George
 * @package App\Http\Controllers
 */
class RepositoryController extends Controller
{
	/**
	 * 查询项目仓库信息
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

		$repositories = Repository::query()
			->where('project_id', $request->project_id)
			->get();

		return success($repositories);
    }

	/**
	 * 创建仓库信息
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
        	'url' => 'required|string|unique:repositories',
        	'protocol' => 'required|string',
        	'type' => 'required|string'
		]);

        $repository = Repository::create($attributes);
        return stored($repository);
    }

	/**
	 * 获取项目仓库详情
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Repository $repository
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Repository $repository)
    {
        return success($repository);
    }

	/**
	 * 更新项目仓库信息
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Request $request
	 * @param Repository $repository
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Repository $repository)
    {
		$attributes = $this->validate($request, [
			'url' => [
				'required',
				'string',
				Rule::unique('repositories')->ignoreModel($repository)
			],
			'protocol' => 'required|string',
			'type' => 'required|string'
		]);

		$repository->update($attributes);
		return updated($repository);
    }

	/**
	 * 删除项目仓库信息
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Repository $repository
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Repository $repository)
    {
        $repository->delete();
        return deleted();
    }
}
