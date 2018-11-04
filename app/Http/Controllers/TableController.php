<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

/**
 * 数据表逻辑控制器
 *
 * Date: 2018/11/4
 * @author George
 * @package App\Http\Controllers
 */
class TableController extends Controller
{
	/**
	 * 获取数据表
	 *
	 * Date: 2018/11/4
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function index(Request $request)
    {
        $this->validate($request, [
        	'database_id' => 'required|integer',
			'name' => 'filled|string'
		]);

        $query = Table::query()->where('database_id', $request->database_id);

        if ($name = $request->get('name')) {
        	$query->where('name', 'like', "%{$name}%");
		}

		return success($query->paginate($request->get('paginate')));
    }

	/**
	 * 创建数据表
	 *
	 * Date: 2018/11/4
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
        	'database_id' => 'required|integer',
        	'name' => 'required|string',
        	'engine' => 'required|string',
        	'comment' => 'required|string',
		]);

        $table = Table::create($attributes);
        return stored($table);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$result = Table::with('fields')->where('id', $id)->get();
    	return success($result);
    }

	/**
	 * 更新数据表信息
	 *
	 * Date: 2018/11/4
	 * @author George
	 * @param Request $request
	 * @param Table $table
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Table $table)
    {
		$attributes = $this->validate($request, [
			'name' => 'required|string',
			'engine' => 'required|string',
			'comment' => 'required|string',
			'statements' => 'required|string'
		]);

		$table->update($attributes);

		return success($table);
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
