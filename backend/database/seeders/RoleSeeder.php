<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            [
                'id' => 1,
                'role_name' => 'sup_admin',
                'description' => '',
            ],
            [
                'id' => 2,
                'role_name' => 'admin',
                'description' => '',
            ],
            [
                'id' => 3,
                'role_name' => 'user',
                'description' => '',
            ],
        ]);
    }
}
