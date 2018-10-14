<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 用户模拟数据填充器
 *
 * Date: 2018/10/14
 * @author George
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'George',
                'email' => 'george@betterde.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt('Betterde'),
                'avatar' => '',
                'mobile' => '',
                'wechat' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('users')->insert($users);
    }
}
