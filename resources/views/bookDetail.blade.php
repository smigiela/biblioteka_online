<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="ml-10 menuAdmin">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">

                    <h1 style="text-align: center">{{$book->title}}</h1>
                    <h4 style="text-align: center">Wypożyczeń: <span class="fw-bold">

                            @if (is_null($borrowedTimes))
                                0
                            @else
                                {{$borrowedTimes}}
                            @endif

                        </span></h4>

                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tbody>
                        <tr class="trBorder"></tr>

                        <tr class="trBorder">
                            <td class="tdLeft">Tytuł</td>
                            <td class="tdRight">{{$book->title}}</td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft">ISBN</td>
                            <td class="tdRight">{{$book->ISBN}}</td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft">Autor</td>
                            <td class="tdRight">{{$book->author->fname}} {{$book->author->lname}}</td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft">Gatunek</td>
                            <td class="tdRight">{{$book->category->nameOfCategory}}</td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft">Wydawca</td>
                            <td class="tdRight">

                                @if (is_null($book->publisher))
                                    Brak Danych
                                @else
                                    {{$book->publisher}}
                                @endif

                            </td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft">Język</td>
                            <td class="tdRight">

                                @if (is_null($book->language))
                                    Brak Danych
                                @else
                                    {{$book->language}}
                                @endif

                            </td>
                        </tr>

                        <tr class="trBorder">
                            <td class="tdLeft">Opis</td>
                            <td class="tdRight">

                                @if (is_null($book->description))
                                    Brak Danych
                                @else
                                    {{$book->description}}
                                @endif

                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
