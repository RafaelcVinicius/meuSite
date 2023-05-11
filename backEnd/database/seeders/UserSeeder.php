<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'uuid' => '2b6d8c50-13a8-4ccc-8d29-ea18b345e865',
            'name' => 'rafael',
            'email' => 'rafael.coldebellaa@gmail.com',
        ]);
    }
}
