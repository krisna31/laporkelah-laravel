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
                'foto' => 'abdddc',
                'company_id' => null,
                'created_at' => now(),
            ],
            [
                'name' => "admin",
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role_id' => 2,
                'foto' => 'asbc',
                'company_id' => 1,
                'created_at' => now(),
            ],
            [
                'name' => "user",
                'email' => 'user@gmail.com',
                'password' => bcrypt('user'),
                'role_id' => 3,
                'foto' => 'adbc',
                'company_id' => 2,
                'created_at' => now(),
            ]
        ]);

        User::factory(50)->create();
    }
}
