<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title'      => 'Default Category',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        DB::table('provinces')->insert([
            [
                'title'      => 'Balkh',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Badakhshan',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Bamyan',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Ghazni',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('stakeholder_roles')->insert([
            [
                'title'      => 'Partner',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Donnar',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        DB::table('thematic_areas')->insert([
            [
                'title'      => 'Default Thematic Area',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        DB::table('complaint_types')->insert([
            [
                'title'      => 'Request for information',
                'type'       => 'Insensitive',
                'deadline'   => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Request for Assistant',
                'type'       => 'Insensitive',
                'deadline'   => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Major dissatisfaction with activities and behavior of staff (missing items from kits, lack follow up etc.)',
                'type'       => 'Insensitive',
                'deadline'   => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Major dissatisfaction with activities.',
                'type'       => 'Insensitive',
                'deadline'   => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Breaches of TLO code of conduct or chilled or women safeguarding policy. ',
                'type'       => 'Sensitive',
                'deadline'   => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'      => 'Allegation of chilled abuse or sexual exploitation of beneficiaries.',
                'type'       => 'Sensitive',
                'deadline'   => 15,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
