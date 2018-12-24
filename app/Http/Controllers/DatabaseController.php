<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Database;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 项目数据库设计逻辑控制器
 *
 * Date: 2018/10/28
 * @author George
 * @package App\Http\Controllers
 */
class DatabaseController extends Controller
{
	/**
	 * 获取项目的数据库
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
        	'project_id' => 'required|integer',
			'name' => 'filled|string',
		]);

        $query = Database::query()->where('project_id', $request->project_id);

        if ($name = $request->get('name')) {
        	$query->where('name', 'like', "%{$name}%");
		}

		return success($query->paginate($request->get('paginate')));
    }

	/**
	 * 创建数据库
	 *
	 * Date: 2018/10/28
	 * @author George
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
        	'project_id' => 'required|integer',
        	'version_id' => 'filled|integer',
        	'module_id' => 'filled|integer',
        	'name' => 'required|string',
        	'character' => 'filled|string',
        	'collection' => 'filled|string',
		]);

        $database = Database::create($attributes);
        return stored($database);
    }

    /**
     * 获取数据库及表信息
     *
     * Date: 2018-12-24
     * @author George
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $database = Database::query()->with('tables')->findOrFail($id);
        return success($database);
    }

    /**
     * 修改数据库信息
     *
     * Date: 2018-12-24
     * @author George
     * @param Request $request
     * @param Database $database
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Database $database)
    {
        $attributes = $this->validate($request, [
            'project_id' => 'required|integer',
            'version_id' => 'filled|integer',
            'module_id' => 'filled|integer',
            'name' => 'required|string',
            'character' => 'filled|string',
            'collection' => 'filled|string',
        ]);

        $database->update($attributes);
        return updated($database);
    }

    /**
     * 删除数据库
     *
     * Date: 2018-12-24
     * @author George
     * @param Database $database
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function destroy(Database $database)
    {
        try {
            DB::beginTransaction();
            $tables = DB::table('tables')->where('database_id', $database->id)->pluck('id')->toArray();
            DB::table('fields')->whereIn('id', $tables)->delete();
            DB::table('tables')->whereIn('id', $tables)->delete();
            $database->delete();
            DB::commit();
            return deleted();
        } catch (Exception $exception) {
            DB::rollBack();
        }
    }
}
