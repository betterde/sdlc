<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
        	[
        		'id' => 1,
        		'name' => 'HRMS',
        		'description' => 'Human Resource Management System',
        		'type_id' => 1,
        		'owner' => 1,
        		'cover' => '',
        		'status' => 'collect',
        		'public' => false,
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s')
			],[
        		'id' => 2,
        		'name' => 'SDLC',
        		'description' => 'Software Development Life Cycle',
        		'type_id' => 1,
        		'owner' => 1,
        		'cover' => '',
        		'status' => 'collect',
        		'public' => false,
        		'created_at' => date('Y-m-d H:i:s'),
        		'updated_at' => date('Y-m-d H:i:s')
			],
		];

        DB::table('projects')->insert($projects);
    }
}
