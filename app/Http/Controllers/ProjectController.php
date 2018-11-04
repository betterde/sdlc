<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * 项目逻辑控制器
 *
 * Date: 2018/9/8
 * @author George
 * @package App\Http\Controllers\Staff
 */
class ProjectController extends Controller
{
    /**
     * 查询项目列表
     *
     * Date: 2018/9/8
     * @author George
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $paginate = $request->get('paginate', 10);

        $query = Project::query();

        $query->where(function ($query) use ($request) {
			/**
			 * @var Builder $query
			 */
        	$query->where('public', false);
			if ($name = $request->get('name')) {
				$query->where('name', 'like', "%{$name}%");
			}
		});

        $query->orWhereHas('members', function ($query) use ($request) {
			/**
			 * @var Builder $query
			 */
        	$query->where('user_id', Auth::user()->id);

			if ($name = $request->get('name')) {
				$query->where('name', 'like', "%{$name}%");
			}
		});

        return success($query->paginate($paginate));
    }

	/**
	 * 创建项目
	 *
	 * Date: 2018/10/15
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

		$attributes = $this->validate($request, [
			'name' => 'required|string',
			'description' => 'filled|string',
			'type_id' => 'required|integer',
			'cover' => 'filled|string',
			'status' => 'required|string',
		]);

		$attributes['owner'] = $user->getKey();
		$project = Project::create($attributes);
		return stored($project);
    }

	/**
	 * 获取项目详情
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Project $project
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Project $project)
    {
    	return success($project);
    }

	/**
	 * 更新项目信息
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Request $request
	 * @param Project $project
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Project $project)
    {
        $attributes = $this->validate($request, [
            'name' => 'filled|string',
            'description' => 'filled|string',
            'type_id' => 'filled|integer',
            'owner' => 'filled|integer',
            'cover' => 'filled|string',
            'status' => 'filled|string',
            'public' => 'filled|boolean'
        ]);

        $project->update($attributes);

        return updated($project);
    }

	/**
	 * 删除项目
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Project $project
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Project $project)
    {
		$project->delete();
		return deleted();
	}
}
