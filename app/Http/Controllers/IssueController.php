<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 项目Issue逻辑控制器
 *
 * Date: 2018/10/18
 * @author George
 * @package App\Http\Controllers
 */
class IssueController extends Controller
{
	/**
	 * 获取项目Issue
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
			'title' => 'filled|string',
			'content' => 'filled|string',
			'priority' => 'filled|integer',
			'severity' => 'filled|integer',
			'version_id' => 'filled|integer',
			'module_id' => 'filled|integer',
			'author_id' => 'filled|integer',
			'status' => 'filled|string',
		]);

		$paginate = $request->get('paginate', 10);

		$query = Issue::query()->where('project_id', $request->project_id);

		if ($title = $request->get('title')) {
			$query->where('title', 'like', "%{$title}%");
		}

		if ($content = $request->get('content')) {
			$query->where('content', 'like', "%{$content}%");
		}

		if ($priority = $request->get('priority')) {
			$query->where('priority', $priority);
		}

		if ($severity = $request->get('severity')) {
			$query->where('severity', $severity);
		}

		if ($version_id = $request->get('version_id')) {
			$query->where('version_id', $version_id);
		}

		if ($module_id = $request->get('module_id')) {
			$query->where('module_id', $module_id);
		}

		if ($author_id = $request->get('author_id')) {
			$query->where('author_id', $author_id);
		}
		if ($status = $request->get('status')) {
			$query->where('status', $status);
		}

		return success($query->paginate($paginate));
	}

	/**
	 * 创建项目Issue
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
        	'version_id' => 'required|integer',
        	'module_id' => 'required|integer',
        	'title' => 'required|string',
        	'content' => 'required|string',
        	'priority' => 'required|integer',
        	'severity' => 'required|integer',
        	'status' => 'required|string'
		]);

        $issue = Issue::create($attributes);
        return success($issue);
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
	 * 更新项目Issue内容
	 *
	 * Date: 2018/10/18
	 * @author George
	 * @param Request $request
	 * @param Issue $issue
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Issue $issue)
    {
        $attributes = $this->validate($request, [
        	'version_id' => 'filled|integer',
        	'module_id' => 'filled|integer',
        	'author_id' => 'filled|integer',
        	'title' => 'filled|string',
        	'content' => 'filled|string',
        	'priority' => 'filled|integer',
        	'severity' => 'filled|integer',
        	'status' => 'filled|string'
		]);

        if ($issue->author_id !== Auth::id()) {
        	return failed('无权访问', 403);
		}

        $issue->update($attributes);
        return updated($issue);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
