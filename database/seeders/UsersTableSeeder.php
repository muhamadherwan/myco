<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('users')->truncate(); //for cleaning earlier data to avoid duplicate entries
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@grtech.com.my',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@grtech.com.my',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}
