<?php

namespace Database\Seeders;

use App\Models\SectionTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectionTitle::insert([
            [
                'key' => 'why_choose_top_title',
                'value' => 'Why Choose Us',
            ],
            [
                'key' => 'why_choose_main_title',
                'value' => 'Why would you choose us',
            ],
            [
                'key' => 'why_choose_sub_title',
                'value' => 'Here are the reasons',
            ],
        ]);
    }
}
