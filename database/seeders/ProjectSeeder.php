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
            'start_date' => time(),
            'end_date' => strtotime('+1 year'),
            'funding' => '100000',
            'donnor' => 'Sample Donor',
            'partner' => 'Sample Partner',
            'description' => 'This is a sample project description.',
            'province_id' => 1,
            'assigned_to' => 1,
            'category_id' => 1,
            'status' => 'Implementation',
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
