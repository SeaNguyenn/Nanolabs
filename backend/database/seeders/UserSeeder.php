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
                'avatar' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
                'email' => 'boss@gmail.com',
                'role_id' => 1,
                'is_active' => 1,
            ],
            [
                'id' => 2,
                'account_id' => 'admin',
                'password' => Hash::make('1'),
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'avatar' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
                'role_id' => 2,
                'is_active' => 1,
            ],
            [
                'id' => 3,
                'account_id' => 'user',
                'password' => Hash::make('1'),
                'name' => 'user',
                'email' => 'user@gmail.com',
                'avatar' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
                'role_id' => 3,
                'is_active' => 1,
            ],
        ]);
    }
}
