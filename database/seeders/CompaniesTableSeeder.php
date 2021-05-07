<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->truncate(); //for cleaning earlier data to avoid duplicate entries
        
        DB::table('companies')->insert([
            'name' => 'Facebook',
            'email' => 'info@facebook.com',
            'website' => 'facebook.com',
        ]);
        
        DB::table('companies')->insert([
            'name' => 'Google',
            'email' => 'info@google.com',
            'website' => 'google.com',
        ]);

        DB::table('companies')->insert([
            'name' => 'Laravel',
            'email' => 'info@laravel.com',
            'website' => 'laravel.com',
        ]);
    }
}
