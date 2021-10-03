<?php

namespace Database\Seeders;

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
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'name' => 'Użytkownik',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678')
        ]);
        DB::table('users')->insert([
            'name' => 'Jan Nowak',
            'email' => 'jnowak@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
