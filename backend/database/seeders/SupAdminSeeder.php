<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class SupAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'account_id' => 'sup_admin',
            'password' => Hash::make(1),
            'name' => 'sup_admin',
            'email' => 'supadmin@gmail.com',
            'role_id' => 1,
            'state' => 1,
        ]);
    }
}
