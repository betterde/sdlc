<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 项目类型模拟数据填充器
 *
 * Date: 2018/9/30
 * @author George
 */
class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'API',
            'iOS',
            'Android',
            'H5',
            'Web',
            'Desktop',
            'IoT',
            'Hardware',
            'Other'
        ];

        $types = [];
        foreach ($names as $name) {
            $types[] = [
                'name' => $name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        DB::table('types')->insert($types);
    }
}
