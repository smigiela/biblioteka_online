<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('authors')->insert([
            'fname' => 'Henryk',
            'lname' => 'Sienkiewicz',
            'nationality' => 'Polska',
            'placeOfBirth' => 'Wola Okrzejska',
            'dateOfBirth' => '1846-05-05',
            'dateOfDeath' => '1916-11-15'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Adam',
            'lname' => 'Mickiewicz',
            'nationality' => 'Polska',
            'placeOfBirth' => 'Nowogródek',
            'dateOfBirth' => '1798-12-24',
            'dateOfDeath' => '1855-11-26'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Juliusz',
            'lname' => 'Słowacki',
            'nationality' => 'Polska',
            'placeOfBirth' => 'Krzemieniec',
            'dateOfBirth' => '1809-09-04',
            'dateOfDeath' => '1849-04-03'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Bolesław',
            'lname' => 'Prus',
            'nationality' => 'Polska',
            'placeOfBirth' => 'Hrubieszów, Królestwo Polskie',
            'dateOfBirth' => '1847-08-20',
            'dateOfDeath' => '1912-05-19'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Stanisław',
            'lname' => 'Wyspiański',
            'nationality' => 'Polska',
            'placeOfBirth' => 'Kraków',
            'dateOfBirth' => '1869-01-15',
            'dateOfDeath' => '1907-11-28'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Aleksander',
            'lname' => 'Fredro',
            'nationality' => 'Polska',
            'placeOfBirth' => 'Surochów',
            'dateOfBirth' => '1793-06-20',
            'dateOfDeath' => '1876-07-15'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Jan',
            'lname' => 'Brzechwa',
            'nationality' => 'Polska',
            'placeOfBirth' => 'Żmerynka',
            'dateOfBirth' => '1898-08-15',
            'dateOfDeath' => '1966-07-02'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Stephen',
            'lname' => 'King',
            'nationality' => 'Ameryka',
            'placeOfBirth' => 'Portland, Maine',
            'dateOfBirth' => '1947-09-21'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Nicholas',
            'lname' => 'Sparks',
            'nationality' => 'Ameryka',
            'placeOfBirth' => 'Omaha',
            'dateOfBirth' => '1965-12-31'
        ]);
        DB::table('authors')->insert([
            'fname' => 'Danielle',
            'lname' => 'Steel',
            'nationality' => 'Ameryka',
            'placeOfBirth' => 'Nowy Jork',
            'dateOfBirth' => '1947-08-14'
        ]);
    }
}
