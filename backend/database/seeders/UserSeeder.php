<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;
use Carbon\Carbon;
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
                'image' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
                'email' => 'boss@gmail.com',
                'gender' => 'male',
                'phone' => '+84 912 345 678',
                'address' => '37 Nguyễn Đình Chiểu, Phường 6, Quận 3, Thành phố Hồ Chí Minh, Việt Nam',
                'birthday' => Carbon::now(),
                'role_id' => 'boss',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'account_id' => 'admin',
                'password' => Hash::make('1'),
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'image' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
                'gender' => 'male',
                'phone' => '+84 912 345 678',
                'address' => '10 Phan Chu Trinh, Phường Hàng Bài, Quận Hoàn Kiếm, Thành phố Hà Nội, Việt Nam',
                'birthday' => Carbon::now(),
                'role_id' => 'admin',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'account_id' => 'user',
                'password' => Hash::make('1'),
                'name' => 'user',
                'email' => 'user@gmail.com',
                'image' => 'https://flowbite.com/docs/images/people/profile-picture-5.jpg',
                'gender' => 'male',
                'phone' => '+84 912 345 678',
                'address' => '123 Đường Trần Hưng Đạo, Phường Xuân Thành, Thành phố Nam Định, Tỉnh Nam Định, Việt Nam',
                'birthday' => Carbon::now(),
                'role_id' => 'user',
                'is_active' => true,
            ],
        ]);
    }
}
