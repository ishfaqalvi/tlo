<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class IndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indicators')->insert([
            [
                'project_id'    => 1,
                'name'          => 'First Indicator',
                'format'        => 'Numeric',
                'direction'     => 'Increasing',
                'target'        => 5000,
                'aggregated'    => 'Yes',
            ],
            [
                'project_id'    => 1,
                'name'          => 'Second Indicator',
                'format'        => 'Percentage',
                'direction'     => 'Increasing',
                'target'        => 8000,
                'aggregated'    => null,
            ],
            [
                'project_id'    => 1,
                'name'          => 'Third Indicator',
                'format'        => 'Qualitative Only',
                'direction'     => null,
                'target'        => null,
                'aggregated'    => null,
            ],
        ]);
    }
}
