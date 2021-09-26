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

                    @forelse ($order as $order)
                        <a href="{{ url('/detailOrder/'.$order->id) }}" class="btn">Zamówienie {{$order->id}}</a>
                                    <br>
                    @empty
                                <p>Brak zamówień</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
