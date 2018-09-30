<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Type data generator
 *
 * Date: 2018/9/30
 * @author George
 */
class TypesTableSeeder extends Seeder
{
    /**
     * Date: 2018/9/30
     * @author George
     */
    public function run()
    {
        // Define the system default type name
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

        // Generate an array of attributes by querying the company id form database
        $types = DB::table('companies')->pluck('id')->map(function ($company_id) use ($names) {
            $company_types = [];

            foreach ($names as $name) {
                $company_types[] = [
                    'name' => $name,
                    'company_id' => $company_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }

            return $company_types;
        });

        // Insert the generated array of attributes into the types table
        DB::table('types')->insert($types->collapse()->toArray());
    }
}
