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

                    @foreach($orderDetail as $order)
{{$order}}
{{--                        @foreach($order->carts as $cart)--}}
{{--                            {{$cart->id}},--}}
{{--                            {{$cart->book_id}},--}}
{{--                            {{$cart->order_id}},<br>--}}
{{--                            {{$cart->amount}} * {{$cart->price}} = {{$cart->totalCost}}. <br><br>--}}

{{--                        @endforeach--}}

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
