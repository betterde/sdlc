<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 系统偏好设置数据填充器
 *
 * Date: 2018/10/21
 * @author George
 */
class PreferencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $preferences = [
        	[
        		'name' => 'registration',
        		'description' => '用户注册设置',
        		'value' => 'on',
        		'option' => json_encode([
        			'on' => '开启',
					'off' => '关闭'
				], JSON_UNESCAPED_UNICODE),
			]
		];

        DB::table('preferences')->insert($preferences);
    }
}
