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

                    @foreach($orderDetail as $detail)
                        <h1 style="text-align: center">{{$detail->orderNumber}}</h1>
                    @endforeach

                    @foreach($orderDetail as $order)
                        <h4 style="text-align: center">{{$order->created_at}}</h4>


                        @foreach($order->carts as $cart)
                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                <tbody>
                                <tr class="trBorder"></tr>
                                <tr class="trBorder">
                                    <td class="tdLeft">{{$cart->book->title}}</td>
                                    <td class="tdRight">{{$cart->amount}} * {{$cart->price}} zł = {{$cart->totalCost}} zł.</td>
                                </tr>
                                </tbody>
                            </table>
                        @endforeach


                    @endforeach
                    <h4 style="margin-top: 20px; text-align: center">Łączny koszt: <span class="fw-bold">{{$totalPrice}} zł</span></h4>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
