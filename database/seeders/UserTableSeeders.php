<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "Paulo Martim",
                'email' => "vpaulo95@yahoo.com.br",
                'password' => bcrypt('123456'),
                'account' => '2523',
                'balance' => '2536.25',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => "Jheniffer Oliveira",
                'email' => "paulomartim93@gmail.com",
                'password' => bcrypt('123456'),
                'account' => '2022',
                'balance' => '150.25',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
