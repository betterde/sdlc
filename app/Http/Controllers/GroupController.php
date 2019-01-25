<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * API分组逻辑控制器
 *
 * Date: 2019-01-21
 * @author George
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    /**
     * 获取项目的API分组数据
     *
     * Date: 2019-01-21
     * @author George
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'project_id' => 'required|numeric'
        ]);

        $groups = Group::query()
            ->where('project_id', $request->get('project_id'))
            ->where(['scene', Group::SCENE_API])
            ->get();
        return success($groups);
    }

    /**
     * 创建API资源分组
     *
     * Date: 2019-01-21
     * @author George
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'scene' => 'required',
            'parent_id' => 'nullable',
            'name' => 'required',
        ]);

        $group = Group::create($attributes);
        return stored($group);
    }

    /**
     * 获取指定分组详情信息
     *
     * Date: 2019-01-21
     * @author George
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Group $group)
    {
        return success($group);
    }

    /**
     * 更新分组信息
     *
     * Date: 2019-01-25
     * @author George
     * @param Request $request
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Group $group)
    {
        $attributes = $this->validate($request, [
            'parent_id' => 'nullable',
            'name' => 'required',
        ]);

        $group->update($attributes);
        return updated($group);
    }

    /**
     * 删除分组信息
     *
     * Date: 2019-01-25
     * @author George
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function destroy(Group $group)
    {
        try {
            DB::beginTransaction();
            switch ($group->scene) {
                case 'interfaces':
                    $group->interfaces()->update(['group_id' => 0]);
                    break;
                default:
                    return failed('未知的场景分组', 500);
            }
            $group->delete();
            DB::commit();
            return deleted();
        } catch (Exception $exception) {
            DB::rollBack();
            return failed('删除失败', 500);
        }
    }
}
