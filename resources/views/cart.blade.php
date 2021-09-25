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

                    <div class="d-flex justify-content-evenly">
                        @if (session('messageGreen'))
                            <div class="alert alert-success">
                                {{ session('messageGreen') }}
                            </div>
                        @elseif(session('messageRed'))
                            <div class="alert alert-danger">
                                {{ session('messageRed') }}
                            </div>
                        @endif
                    </div>

                    @foreach($cart as $cart)
                        <p>{{$cart->user->name}},
                        {{$cart->book->title}},
                        {{$cart->amount}},
                        {{$cart->book->price}},
                        {{$cart->totalCost}},
                        <a href="{{ url('/deleteCart/'.$cart->id) }}" class="btn btn-sm btn-danger">Usuń</a>
                        </p>
                    @endforeach

                    <a href="{{ url('submitOrder') }}" class="btn btn-sm btn-success">Złóż zamówienie</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
