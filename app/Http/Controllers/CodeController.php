<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;

/**
 * 响应状态吗逻辑控制器
 *
 * Date: 2018/11/5
 * @author George
 * @package App\Http\Controllers
 */
class CodeController extends Controller
{
	/**
	 * 获取项目响应状态码
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function index(Request $request)
    {
    	$this->validate($request, [
    		'project_id' => 'required|integer',
    		'group_id' => 'filled|integer',
			'code' => 'filled|integer',
			'description' => 'filled|string'
		]);

    	$query = Code::query()->where('project_id', $request->project_id);

    	if ($group_id = $request->get('group_id')) {
    		$query->where('group_id', $group_id);
		}

		if ($code = $request->get('code')) {
			$query->where('code', $code);
		}

		if ($description = $request->get('description')) {
			$query->where('description', 'like', "%{$description}%");
		}

		return success($query->paginate($request->get('paginate')));
    }

	/**
	 * 创建响应状态吗
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
        	'project_id' => 'required|integer',
        	'group_id' => 'required|integer',
        	'number' => 'required|integer',
        	'description' => 'filled|string'
		]);

        $code = Code::create($attributes);
        return stored($code);
    }

	/**
	 * 获取状态吗详情
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Code $code
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Code $code)
    {
        return success($code);
    }

	/**
	 * 更新状态码信息
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Request $request
	 * @param Code $code
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Code $code)
    {
		$attributes = $this->validate($request, [
			'group_id' => 'required|integer',
			'number' => 'required|integer',
			'description' => 'filled|string'
		]);

		$code->update($attributes);
		return updated($code);
    }

	/**
	 * 删除状态码
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Code $code
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Code $code)
    {
    	$code->delete();
    	return deleted();
    }
}
