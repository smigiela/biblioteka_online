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
            'password' => Hash::make('12345678'),
            'living' => 'Miasto',
            'age' => '23',
            'gender' => 'Mężczyzna',
            'voivodeship' => 'Podkarpackie',
            'education' => 'Średnie'
        ]);
        DB::table('users')->insert([
            'name' => 'Użytkownik',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'living' => 'Miasto',
            'age' => '30',
            'gender' => 'Mężczyzna',
            'voivodeship' => 'Pomorskie',
            'education' => 'Wyższe'
        ]);
//        DB::table('users')->insert([
//            'name' => 'Jan Nowak',
//            'email' => 'jnowak@gmail.com',
//            'password' => Hash::make('12345678'),
//            'living' => 'Wieś',
//            'age' => '46',
//            'gender' => 'Mężczyzna',
//            'voivodeship' => 'Sląskie',
//            'education' => 'Podstawowe'
//        ]);
//        DB::table('users')->insert([
//            'name' => 'Adam Kowalski',
//            'email' => 'akowalski@gmail.com',
//            'password' => Hash::make('12345678'),
//            'living' => 'Wieś',
//            'age' => '56',
//            'gender' => 'Mężczyzna',
//            'voivodeship' => 'Podkarpackie',
//            'education' => 'Zawodowe'
//        ]);
//        DB::table('users')->insert([
//            'name' => 'Michał Kował',
//            'email' => 'mkowal@gmail.com',
//            'password' => Hash::make('12345678'),
//            'living' => 'Miasto',
//            'age' => '19',
//            'gender' => 'Mężczyzna',
//            'voivodeship' => 'Zachodnio-Pomorskie',
//            'education' => 'Zawodowe'
//        ]);
    }
}
