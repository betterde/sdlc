<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Http\Resources\MenuCollection;

/**
 * 系统菜单逻辑控制器
 *
 * Date: 2018-12-24
 * @author George
 * @package App\Http\Controllers
 */
class MenuController extends Controller
{
    /**
     * Date: 2018-12-24
     * @author George
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $menus = Menu::paginate();
        $resource = new MenuCollection($menus);
//        return $resource->response();
        return success($resource);
    }
}
