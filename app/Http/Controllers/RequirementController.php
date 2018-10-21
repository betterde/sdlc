<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 项目需求逻辑控制器
 *
 * Date: 2018/10/21
 * @author George
 * @package App\Http\Controllers
 */
class RequirementController extends Controller
{
	/**
	 * 获取项目的需求列表
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function index(Request $request)
    {
    	$this->validate($request, [
    		'project_id' => 'required|integer'
		]);

    	$query = Requirement::query()->where('project_id', $request->project_id);

    	if ($title = $request->get('title')) {
    		$query->where('title', 'like', "%{$title}%");
		}

		if ($version_id = $request->get('version_id')) {
			$query->where('version_id', $version_id);
		}

		if ($module_id = $request->get('module_id')) {
			$query->where('module_id', $module_id);
		}

		if ($creator = $request->get('creator')) {
			$query->where('creator', $creator);
		}

		if ($priority = $request->get('priority')) {
			$query->where('priority', $priority);
		}

		if ($severity = $request->get('severity')) {
			$query->where('severity', $severity);
		}

		if ($start = $request->get('start') && $end = $request->get('end')) {
			$query->whereBetween('delivery_at', [$start, $end]);
		}

		$requirements = $query->paginate($request->get('paginate'));
		return success($requirements);
    }

	/**
	 * 创建项目需求
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
        	'project_id' => 'rquired|integer',
        	'version_id' => 'filled|integer',
        	'module_id' => 'filled|integer',
        	'title' => 'rquired|string',
        	'content' => 'rquired|string',
			'priority' => 'required|integer',
			'severity' => 'required|integer',
        	'delivery_at' => 'filled|date_format:Y-m-d H:i:s'
		]);

        $attributes['creator'] = Auth::id();

        $requirement = Requirement::create($attributes);
        return stored($requirement);
    }

	/**
	 * 获取项目需求详情信息
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Requirement $requirement
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Requirement $requirement)
    {
    	return success($requirement);
    }

	/**
	 * 更新项目需求详情信息
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param Request $request
	 * @param Requirement $requirement
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Requirement $requirement)
    {
		$attributes = $this->validate($request, [
			'version_id' => 'filled|integer',
			'module_id' => 'filled|integer',
			'title' => 'rquired|string',
			'content' => 'rquired|string',
			'priority' => 'required|integer',
			'severity' => 'required|integer',
			'delivery_at' => 'filled|date_format:Y-m-d H:i:s'
		]);

		$requirement->update($attributes);
		return updated($requirement);
    }

	/**
	 * 删除需求功能待定
	 *
	 * Date: 2018/10/21
	 * @author George
	 * @param integer $id
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function destroy($id)
    {
        return failed('无权访问', 403);
    }
}
