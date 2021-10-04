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


                    <h2 style="margin-bottom: 3vh;" class="text-center">Katalog książek</h2>

                    <form action="{{ url('/book/search') }}" method="get">
                        @csrf

                        <div class="searchBar">

                            <div class="searchBarLeft">
                                <input class="btn btn-outline-success inputSearch cursorSearch" placeholder="Szukaj książki... " type="text" id="findTitle" name="findTitle">
                            </div>

                            <div class="searchBarRight">
                                <input class="btn btn-outline-success inputSearch" type="submit" value="Szukaj / Resetuj">
                            </div>

                        </div>

                    </form>
                    <br>
                    <br>

                    @if($books->count())

                        @foreach ($books as $book)
                            <div class="oneOfBook card">

                                <h5 class="card-header">
                                    <div class="text-center">
                                        <a href="{{ url('/detailBook/'.$book->id) }}"
                                           class="cartColor">{{$book->title}}</a>
                                    </div>
                                </h5>

                                <div class="card-body">

                                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                        <tbody>

                                        <tr class="trBorder">
                                            <td class="tdLeft">Autor</td>
                                            <td class="tdRight">{{$book->author->fname}} {{$book->author->lname}}</td>
                                        </tr>

                                        <tr class="trBorder">
                                            <td class="tdLeft">Gatunek</td>
                                            <td class="tdRight">{{$book->category->nameOfCategory}}</td>
                                        </tr>

                                        <tr class="trBorder">
                                            <td class="tdLeft">Cena</td>
                                            <td class="tdRight">{{$book->price}} zł</td>
                                        </tr>

                                        <tr class="trBorder" style="border: none;">
                                            <td class="tdLeft">Dostępnych </td>
                                            <td class="tdRight">
                                                @if($book->amount <= 0)
                                                    <span style="color: red;">Niedostępne</span>
                                                @else
                                                    {{$book->amount}} sztuk
                                                @endif
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                    <form action="{{ url('addToCart') }}" method="post" novalidate>
                                        @csrf
                                        <input name="user_id" type="hidden" value="{{Auth::user()->id}}">
                                        <input name="book_id" type="hidden" value="{{$book->id}}">
                                        <input name="amount" type="hidden" value="{{$book->amount}}">
                                        <input name="amount_default" type="hidden" value="1">
                                        <input name="price" type="hidden" value="{{$book->price}}">
                                        <input name="author_lname" type="hidden" value="{{$book->author->lname}}">
                                        <input name="author_fname" type="hidden" value="{{$book->author->fname}}">
                                        <input name="category" type="hidden"
                                               value="{{$book->category->nameOfCategory}}">
                                        <div class="text-center">

                                            @if($book->amount <= 0)
                                                <button class="btn btn-outline-success" type="submit"  disabled>Dodaj do koszyka
                                                </button>
                                            @else
                                                <button class="btn btn-outline-success" type="submit">Dodaj do koszyka
                                                </button>
                                            @endif

                                        </div>
                                    </form>

                                </div>

                            </div>
                        @endforeach
                    @else
                        <p style="color:red; text-align: center; font-size: 5vh; margin-top: 5vh;">Brak dostępnych książek!</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
