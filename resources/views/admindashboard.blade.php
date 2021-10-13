<x-app-layout>

    <div class="py-12">
        <div class="ml-10 menuAdmin">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 style="margin-bottom: 5vh" class="text-center">Statystyki użytkownika "{{Auth::user()->name}}"</h2>

                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                        <tr class="trBorder"></tr>

                        <tr class="trBorder">
                            <td class="tdLeft"><h5>Ilość wypozyczonych ksiązek ogółem</h5></td>
                            <td class="tdRight">
                                <h5>
                                    @if (is_null($quantityBooks))
                                        Brak Danych
                                    @else
                                        {{$quantityBooks}}
                                    @endif
                                </h5>
                            </td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft"><h5>Ilość wypozyczonych ksiązek przez ostatnie 30 dni</h5></td>
                            <td class="tdRight">
                                <h5>
                                    @if (is_null($quantityBooksLastMonth))
                                        Brak Danych
                                    @else
                                        {{$quantityBooksLastMonth}}
                                    @endif
                                </h5>
                            </td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft"><h5>Ulubiona książka</h5></td>
                            <td class="tdRight">
                                <h5>
                                    @if (is_null($favoriteBook))
                                        Brak Danych
                                    @else
                                        {{$favoriteBook->book->title}}
                                    @endif
                                </h5>
                            </td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft"><h5>Ulubiony autor</h5></td>
                            <td class="tdRight">
                                <h5>
                                    @if (is_null($favoriteAuthor))
                                        Brak Danych
                                    @else
                                        {{$favoriteAuthor->authorName}} {{$favoriteAuthor->authorSurname}}
                                    @endif
                                </h5>
                            </td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft"><h5>Ulubiony gatunek</h5></td>
                            <td class="tdRight">
                                <h5>
                                    @if (is_null($favoriteCategory))
                                        Brak Danych
                                    @else
                                        {{$favoriteCategory->category}}
                                    @endif
                                </h5>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>

                <div class="p-6 bg-white border-b border-gray-200">

                    <h2 style="margin-bottom: 5vh" class="text-center">Dane użytkownika "{{Auth::user()->name}}"</h2>

                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                        <tr class="trBorder"></tr>

                        <tr class="trBorder">
                            <td class="tdLeft">Nazwa</td>
                            <td class="tdRight">{{Auth::user()->name}}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
