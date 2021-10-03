<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'author_id' => 1,
            'category_id' => 1,
            'ISBN' => 9783846003275,
            'title' => 'Krzyżacy',
            'amount' => '10',
            'price' => '19.99',
            'publisher' => 'Wydawnictwo GREG',
            'language' => 'Polska',
            'description' => 'Powieść przedstawia dzieje konfliktu polsko-krzyżackiego, a akcja utworu toczy się od 1399 (rok śmierci królowej Jadwigi) do 1410 (bitwa pod Grunwaldem). W okresie publikacji powieść była protestem przeciwko germanizacji prowadzonej przez władze zaboru pruskiego.'
        ]);
        DB::table('books')->insert([
            'author_id' => 2,
            'category_id' => 9,
            'ISBN' => 9782322252756,
            'title' => 'Pan Tadeusz',
            'amount' => '12',
            'price' => '24.99',
            'publisher' => 'Wydawnictwo GREG',
            'language' => 'Polska',
            'description' => 'Ta epopeja narodowa (z elementami gawędy szlacheckiej) powstała w latach 1832–1834 w Paryżu. Składa się z dwunastu ksiąg pisanych wierszem, trzynastozgłoskowym aleksandrynem polskim. Czas akcji: pięć dni z roku 1811 i jeden dzień z roku 1812. Epopeja jest stałą pozycją na polskiej liście lektur szkolnych.'
        ]);
        DB::table('books')->insert([
            'author_id' => 4,
            'category_id' => 1,
            'ISBN' => 9788373376809,
            'title' => 'Lalka',
            'amount' => '4',
            'price' => '14.99',
            'publisher' => 'Wydawnictwo MG',
            'language' => 'Polska',
            'description' => 'Bohaterem Lalki jest Stanisław Wokulski, człowiek o dwóch obliczach. Z jednej strony mocno stąpający po ziemi racjonalista, z drugiej romantycznie zakochany idealista. Ona zaś , Izabela Łęcka, typowa kobieta swej epoki, oddzielona murem konwenansów od prawdziwych uczuć, jednak tych uczuć spragniona.'
        ]);
        DB::table('books')->insert([
            'author_id' => 6,
            'category_id' => 4,
            'ISBN' => 9788304016934,
            'title' => 'Zemsta',
            'amount' => '7',
            'price' => '18.99',
            'publisher' => 'Wydawnictwo GREG',
            'language' => 'Polska',
            'description' => 'Głównym wątkiem dramatu Zemsta jest spór o mur graniczny między dwoma sąsiadami – Cześnikiem i Rejentem. Rejent chce naprawić ten mur, a Cześnik na to nie pozwala. Drugim wątkiem utworu jest wątek miłosny. Pojawiają się między bohaterami relacje, których celem jest zawarcie związku małżeńskiego.'
        ]);
    }
}
