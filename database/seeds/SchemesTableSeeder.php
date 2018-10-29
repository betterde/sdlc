<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * URL Scheme 数据填充器
 *
 * Date: 2018/10/27
 * @author George
 */
class SchemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schemes = [
        	[
        		'id' => 1,
        		'name' => 'HTTP',
        		'description' => 'HyperText Transfer Protocol——超文本传输协议',
        		'content' => 'http://',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			],[
        		'id' => 2,
        		'name' => 'HTTPS',
        		'description' => 'Hyper Text Transfer Protocol over Secure Socket Layer',
        		'content' => 'https://',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			],[
        		'id' => 3,
        		'name' => 'WebSocket',
        		'description' => 'WebSocket协议是基于TCP的一种新的网络协议',
        		'content' => 'ws://',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			],[
				'id' => 4,
				'name' => 'WebSocketSSL',
				'description' => 'WebSocket协议是基于TCP的一种新的网络协议',
				'content' => 'wss://',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
			],
		];

        DB::table('schemes')->insert($schemes);
    }
}
