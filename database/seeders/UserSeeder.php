<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('passworddesu'),
            'role' => 1 //管理者
        ],
        [
            'name' => 'chef',
            'email' => 'chef@chef.com',
            'password' => Hash::make('passworddesu'),
            'role' => 5 //運営者(イベントの管理等を行える)
        ],
        [
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('passworddesu'),
            'role' => 9 //ユーザー(ユーザー登録するとここにデータが入る)
        ],
    ]);
    }
}
