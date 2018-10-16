<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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

        $query->where('public', true);

		if ($name = $request->get('name')) {
			$query->where('name', 'like', "%{$name}%");
		}

        $query->orWhereHas('members', function ($query) {
			/**
			 * @var Builder $query
			 */
        	$query->where('user_id', Auth::user()->id);
		});

        $result = $query->paginate($paginate);

        return success($result);
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
			'name' => 'required',
			'description' => 'nullable',
			'type_id' => 'required|integer',
			'cover' => 'nullable'
		], [
			'name.required' => '请输入项目名称',
			'type_id.required' => '请选择项目类型',
			'type_id.integer' => '项目类型有误'
		]);

		$attributes['owner'] = $user->getKey();
		$project = Project::create($attributes);
		return stored($project);
    }

    public function show($id)
    {
        //
    }

    /**
     * 更新项目信息
     *
     * Date: 2018/9/8
     * @author George
     * @param Request $request
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Project $project)
    {
        $attributes = $this->validate($request, [
            'name' => 'required',
            'description' => 'nullable',
            'cover' => 'nullable'
        ], [
            'name.required' => '请输入项目名称'
        ]);

        $project->update($attributes);

        return updated($project);
    }

    public function destroy($id)
    {
        //
    }
}
