<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Companies')->insert([
            [
                'nama_perusahaan' => 'pemerintah',
                'logo' => 'logo.png',
                'is_public' => true
            ],
            [
                'nama_perusahaan' => 'multi data palembang',
                'logo' => 'logo.png',
                'is_public' => false
            ],
        ]);
    }
}
