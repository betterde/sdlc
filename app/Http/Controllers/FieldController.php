<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

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

		return success($query->paginate($request->get('paginate')));
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
        	'table_id' => 'required|integer',
			'name' => 'required|string',
			'type' => 'required|string',
			'length' => 'filled|integer',
			'default' => 'string',
			'character' => 'filled|string',
			'collection' => 'filled|string',
			'description' => 'filled|string',
			'primary' => 'filled|boolean',
			'nullable' => 'filled|boolean',
			'auto_increment' => 'filled|boolean',
			'unsigned' => 'filled|boolean',
			'zerofill' => 'filled|boolean',
			'binary' => 'filled|boolean',
			'key' => 'filled|boolean'
		]);

        $field = Field::create($attributes);

        return stored($field);
    }

	/**
	 * 获取字段详情信息
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Field $field
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function show(Field $field)
    {
    	return success($field);
    }

	/**
	 * 更新表字段信息
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Request $request
	 * @param Field $field
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Field $field)
    {
    	$attributes = $this->validate($request, [
			'name' => [
				'required',
				'string',
				Rule::unique('fields')->where(function (Builder $query) use ($field) {
					return $query->where('table_id','!=', $field->table_id);
				})
			],
			'type' => 'required|string',
			'length' => 'filled|integer',
			'default' => 'filled|string',
			'character' => 'filled|string',
			'collection' => 'filled|string',
			'description' => 'filled|string',
			'primary' => 'filled|boolean',
			'nullable' => 'filled|boolean',
			'auto_increment' => 'filled|boolean',
			'unsigned' => 'filled|boolean',
			'zerofill' => 'filled|boolean',
			'binary' => 'filled|boolean',
			'key' => 'filled|boolean'
		]);

    	$field->update($attributes);

    	return updated($field);
    }

	/**
	 * 删除表字段
	 *
	 * Date: 2018/11/5
	 * @author George
	 * @param Field $field
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
    public function destroy(Field $field)
    {
    	$field->delete();
    	return deleted();
    }
}
