<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = [
            [
                'name' => 'George',
                'mobile' => '18616882860',
                'email' => 'george@betterde.com',
                'password' => bcrypt('George@1994'),
                'avatar' => '',
                'department_id' => 1,
                'position_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('staff')->insert($staff);
    }
}
