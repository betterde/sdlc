<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
	    // System Menu
	    $this->call(MenusTableSeeder::class);

	    // System User
		$this->call(UsersTableSeeder::class);

		// System Type
		$this->call(TypesTableSeeder::class);

		// Request Schemes
		$this->call(SchemesTableSeeder::class);

		// Project
		$this->call(ProjectsTableSeeder::class);

		// System Preference
		$this->call(PreferencesTableSeeder::class);
	}
}
