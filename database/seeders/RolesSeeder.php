<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'jabatan' => 'superadmin',
                'deskripsi' => 'Handle All Companies and Admin until user'
            ],
            [
                'jabatan' => 'admin',
                'deskripsi' => 'Handle One Compoany and user belong to same company'
            ],
            [
                'jabatan' => 'user',
                'deskripsi' => 'User Who Can do the lapor in android app'
            ],
        ]);
    }
}
