<?php

namespace App\Http\Controllers;

use App\Models\Menu;

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
     * Date: 2019-01-06
     * @author George
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $menus = Menu::all();
        return success($menus);
    }
}
