<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'code' => 'PRJ001',
            'name' => 'Sample Project',
            'stage' => 'Implementation',
            'start_date' => time(),
            'end_date' => strtotime('+1 year'),
            'province_id' => 1,
            'assigned_to' => 1,
            'category_id' => 1,
            'funding' => '100000',
            'donnor' => 'Sample Donor',
            'partner' => 'Sample Partner',
            'status' => 'Green',
            'description' => 'This is a sample project description.',
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('project_sites')->insert([
            'project_id' => 1,
            'site_id'    => 1
        ]);
    }
}
