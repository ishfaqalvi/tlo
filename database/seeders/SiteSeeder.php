<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            'thematic_area_id' => 1,
            'province_id' => 1,
            'name' => 'Sample Site',
            'office' => 'Main Office',
            'contact_name' => 'John Doe',
            'contact_number' => '0123456789',
            'latitude' => '33.6667',
            'longitude' => '73.1667',
            'note' => 'This is a sample note.',
            'status' => 'Active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
