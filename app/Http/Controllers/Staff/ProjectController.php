<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $name = $request->get('name');
        $paginate = $request->get('paginate', 10);

        $query = Project::query();

        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }

        $result = $query->paginate($paginate);

        return success($result);
    }

    /**
     * 创建项目
     *
     * Date: 2018/9/8
     * @author George
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        /**
         * @var Staff $user
         */
        $user = Auth::user();

        if ($user instanceof Staff) {
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

        return failed('您无权访问', 403);
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
