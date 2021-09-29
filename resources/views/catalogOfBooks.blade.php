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

                    @if($books->count())

                        @foreach ($books as $book)
                            <div class="oneOfBook card">

                                <h5 class="card-header">{{$book->title}}</h5>

                                <div class="card-body">

                                    <p class="card-text">{{$book->author->fname}} {{$book->author->lname}}</p>
                                    <p class="card-text">{{$book->category->nameOfCategory}}</p>
                                    <p class="card-text">{{$book->price}} zł</p>

                                    <form action="{{ url('addToCart') }}" method="post" novalidate>
                                        @csrf
                                        <input name="user_id" type="hidden" value="{{Auth::user()->id}}">
                                        <input name="book_id" type="hidden" value="{{$book->id}}">
                                        <input name="amount" type="hidden" value="1">
                                        <input name="price" type="hidden" value="{{$book->price}}">
                                        <button class="btn btn-outline-success" type="submit">Dodaj do koszyka</button>
                                    </form>

                                </div>

                            </div>
                        @endforeach
                    @else
                        <p style="color:red; text-align: center; font-size: 5vh;">Brak aktualnie dostępnych książek!</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
