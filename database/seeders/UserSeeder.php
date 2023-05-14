<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "superadmin",
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('superadmin'),
                'role_id' => 1,
                'company_id' => null
            ],
            [
                'name' => "admin",
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role_id' => 2,
                'company_id' => 1
            ],
            [
                'name' => "user",
                'email' => 'user@gmail.com',
                'password' => bcrypt('user'),
                'role_id' => 3,
                'company_id' => 1
            ]
        ]);
    }
}
