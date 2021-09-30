<x-app-layout>

    <div class="py-12">
        <div class="ml-10 menuAdmin">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 style="margin-bottom: 5vh" class="text-center">Statystyki użytkownika "{{Auth::user()->name}}":</h2>
                    <h5>Ilość wypozyczonych ksiązek ogółem:
                        @if (is_null($quantityBooks))
                            Brak Danych
                        @else
                            {{$quantityBooks}}
                        @endif
                    </h5>
                    <h5>Ilość wypozyczonych ksiązek przez ostatnie 30 dni:
                        @if (is_null($quantityBooksLastMonth))
                            Brak Danych
                        @else
                            {{$quantityBooksLastMonth}}
                        @endif
                    </h5>
                    <h5>Ulubiona książka:
                        @if (is_null($favoriteBook))
                            Brak Danych
                        @else
                            {{$favoriteBook->book->title}}
                        @endif
                    </h5>
                    <h5>Ulubiony autor:
                        @if (is_null($favoriteAuthor))
                            Brak Danych
                        @else
                            {{$favoriteAuthor->authorName}} {{$favoriteAuthor->authorSurname}}
                        @endif
                    </h5>
                    <h5>Ulubiony gatunek:
                        @if (is_null($favoriteCategory))
                            Brak Danych
                        @else
                            {{$favoriteCategory->category}}
                        @endif
                    </h5>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
