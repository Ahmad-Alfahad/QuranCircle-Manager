<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('surahs')->insert([

            [
                'name' => 'الفاتحة',
                'total_ayahs' => 7,
                'order' => 1,
                'juz' => 1,
                'hizb' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'البقرة',
                'total_ayahs' => 286,
                'order' => 2,
                'juz' => 1,
                'hizb' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'آل عمران',
                'total_ayahs' => 200,
                'order' => 3,
                'juz' => 3,
                'hizb' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'النساء',
                'total_ayahs' => 176,
                'order' => 4,
                'juz' => 4,
                'hizb' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}