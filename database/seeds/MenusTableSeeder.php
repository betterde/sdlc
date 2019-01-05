<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'id' => 1,
                'name' => '项目',
                'description' => '项目管理',
                'icon' => 'project',
                'route' => null,
                'scope' => 'global',
                'parent_id' => 0
            ],[
                'id' => 2,
                'name' => '任务',
                'description' => '项目管理',
                'icon' => 'project',
                'route' => null,
                'scope' => 'global',
                'parent_id' => 0
            ],[
                'id' => 3,
                'name' => '需求',
                'description' => '项目管理',
                'icon' => 'project',
                'route' => null,
                'scope' => 'global',
                'parent_id' => 0
            ],[
                'id' => 4,
                'name' => '团队',
                'description' => '项目管理',
                'icon' => 'project',
                'route' => null,
                'scope' => 'global',
                'parent_id' => 0
            ],[
                'id' => 5,
                'name' => '文档',
                'description' => '项目管理',
                'icon' => 'project',
                'route' => null,
                'scope' => 'global',
                'parent_id' => 0
            ],
        ];

        DB::table('menus')->insert($menus);
    }
}
