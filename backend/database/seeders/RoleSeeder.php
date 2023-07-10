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
                'name' => 'sup_admin',
            ],
            [
                'id' => 2,
                'name' => 'admin',
            ],
            [
                'id' => 3,
                'name' => 'user',
            ],
        ]);
    }
}
