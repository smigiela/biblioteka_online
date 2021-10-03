<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'nameOfCategory' => 'Powieść'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Opowiadanie'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Dramat'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Komedia'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Romans'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Thriller'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Fantasy'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Baśń'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Poezja'
        ]);
        DB::table('categories')->insert([
            'nameOfCategory' => 'Inne'
        ]);
    }
}
