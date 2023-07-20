<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'account_id' => 'boss',
                'password' => Hash::make('1'),
                'name' => 'boss',
                'email' => 'boss@gmail.com',
                'role_id' => 1,
                'state' => 1,
            ],
            [
                'id' => 2,
                'account_id' => 'admin',
                'password' => Hash::make('1'),
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role_id' => 2,
                'state' => 1,
            ],
            [
                'id' => 3,
                'account_id' => 'user',
                'password' => Hash::make('1'),
                'name' => 'user',
                'email' => 'user@gmail.com',
                'role_id' => 1,
                'state' => 1,
            ],
        ]);
    }
}
