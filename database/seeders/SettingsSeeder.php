<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' 	=> 'header_logo',
                'value' => 'upload/images/settings/derivative-calculator-logo.webp',
            ],
            [
                'key' 	=> 'footer_logo',
                'value' => 'upload/images/settings/derivative-calculator-logo.webp',
            ],
            [
                'key'   => 'page_title_icon',
                'value' => 'upload/images/settings/derivative-favicon.png',
            ],
            [
                'key'   => 'bazigate_website_url',
                'value' => '',
            ]
        ]);
    }
}
