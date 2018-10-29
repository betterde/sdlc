<?php

namespace App\Http\Controllers;

use App\Models\Database;
use Illuminate\Http\Request;

/**
 * 项目数据库设计逻辑控制器
 *
 * Date: 2018/10/28
 * @author George
 * @package App\Http\Controllers
 */
class DatabaseController extends Controller
{
    public function index(Request $request)
    {
        //
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
