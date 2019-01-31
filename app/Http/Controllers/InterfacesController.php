<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Interfaces;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

/**
 * 接口逻辑控制器
 *
 * Date: 2019-01-26
 * @author George
 * @package App\Http\Controllers
 */
class InterfacesController extends Controller
{
    /**
     * Date: 2019-01-26
     * @author George
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'project_id' => 'required|numeric',
            'version_id' => 'filled|numeric',
            'module_id' => 'filled|numeric',
            'group_id' => 'filled|numeric',
            'scheme' => 'filled|string',
            'name' => 'filled|string',
            'method' => 'filled|string',
            'uri' => 'filled|string',
            'status' => 'filled|string',
            'explain' => 'filled|string',
        ]);

        $query = Interfaces::query();
        $query->where('project_id', $request->get('project_id'));
        if ($version_id = $request->get('version_id')) {
            $query->where('version_id', $version_id);
        }

        if ($module_id = $request->get('module_id')) {
            $query->where('module_id', $module_id);
        }

        if ($group_id = $request->get('group_id')) {
            $query->where('group_id', $group_id);
        }

        if ($scheme = $request->get('scheme')) {
            $query->where('scheme', $scheme);
        }

        if ($name = $request->get('name')) {
            $query->where('name', 'like', "%$name%");
        }

        if ($method = $request->get('method')) {
            $query->where('method', $method);
        }

        if ($uri = $request->get('uri')) {
            $query->where('uri','like', "%$uri%");
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($explain = $request->get('explain')) {
            $query->where('explain', $explain);
        }

        $result = $query->paginate($request->get('paginate'));
        return success($result);
    }

    /**
     * 创建接口信息
     *
     * Date: 2019-01-26
     * @author George
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'project_id' => 'required|numeric',
            'version_id' => 'required|numeric',
            'module_id' => 'required|numeric',
            'group_id' => 'required|numeric',
            'scheme' => 'string',
            'name' => 'string',
            'method' => 'string',
            'uri' => 'string',
            'explain' => 'nullable|string',
        ]);

        $interfaces = Interfaces::create($attributes);
        return stored($interfaces);
    }

    /**
     * 获取接口详情信息
     *
     * Date: 2019-01-26
     * @author George
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $interface = Interfaces::with('requests.arguments', 'requests.headers', 'responses.arguments', 'responses.headers')
            ->where('id', $id)->get();
        return success($interface);
    }

    /**
     * 更新接口信息
     *
     * Date: 2019-01-26
     * @author George
     * @param Request $request
     * @param Interfaces $interfaces
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Interfaces $interfaces)
    {
        $attributes = $this->validate($request, [
            'project_id' => 'required|numeric',
            'version_id' => 'required|numeric',
            'module_id' => 'required|numeric',
            'group_id' => 'required|numeric',
            'scheme' => 'string',
            'name' => 'string',
            'method' => 'string',
            'uri' => 'string',
            'status' => Rule::in([Interfaces::STATUS_NORMAL, Interfaces::STATUS_DEPRECATED]),
            'explain' => 'nullable|string',
        ]);
        $interfaces->update($attributes);
        return updated($interfaces);
    }

    /**
     * 删除接口信息
     *
     * Date: 2019-01-26
     * @author George
     * @param Interfaces $interfaces
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function destroy(Interfaces $interfaces)
    {
        try {
            DB::beginTransaction();
            $interfaces->responses()->delete();
            $interfaces->arguments()->delete();
            $interfaces->delete();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return failed('删除失败');
        }
        return deleted();
    }
}
