<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

/**
 * 数据表字段逻辑控制器
 *
 * Date: 2018/11/4
 * @author George
 * @package App\Http\Controllers
 */
class FieldController extends Controller
{
	/**
	 * 获取数据表字段
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
        	'table_id' => 'required|integer',
			'name' => 'filled|string'
		]);

        $query = Field::query()->where('table_id', $request->table_id);

        if ($name = $request->get('name')) {
        	$query->where('name', 'like', "%{$name}%");
		}

		return success($query->paginate('paginate'));
    }

	/**
	 * 创建表字段
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
        	'name' => 'required|string',
        	'type' => 'required|string',
        	'length' => 'filled|integer',
        	'default' => 'filled|string',
        	'description' => 'filled|string',
        	'primary' => 'filled|boolean',
        	'nullable' => 'filled|boolean',
		]);

        $field = Field::create($attributes);

        return stored($field);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
