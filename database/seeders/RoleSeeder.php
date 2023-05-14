<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'jabatan' => 'superadmin',
                'deskripsi' => 'Handle All Companies and Admin until user'
            ],
            [
                'id' => 2,
                'jabatan' => 'admin',
                'deskripsi' => 'Handle One Compoany and user belong to same company'
            ],
            [
                'id' => 3,
                'jabatan' => 'user',
                'deskripsi' => 'User Who Can do the lapor in android app'
            ],
        ]);
    }
}
