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

                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                    </svg>

                    <div class="d-flex justify-content-evenly">
                        @if (session('messageGreen'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Success:">
                                    <use xlink:href="#check-circle-fill"/>
                                </svg>
                                <div>
                                    {{ session('messageGreen') }}
                                </div>
                            </div>
                        @elseif(session('messageRed'))
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                     aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill"/>
                                </svg>
                                <div>
                                    {{ session('messageRed') }}
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($cart->count())
                        <h1 style="text-align: center">Koszyk</h1>

                        @foreach ($cart as $cart)

                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                                <tbody>
                                <tr style="border-bottom: 1px solid #ccc;"></tr>
                                <tr style="border-bottom: 1px solid #ccc;">
                                    <td style="background-color: white !important; width: 50%; padding: 15px;"><span title="Usuń element"><a
                                                href="{{ url('/deleteCart/'.$cart->id) }}" class="btn deleteHover">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd"
                                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>

                                            </a></span>
                                        <a href="{{ url('/detailBook/'.$cart->book->id) }}" class="cartColor">{{$cart->book->title}}</a>

                                    </td>
                                    <td style="background-color: white !important; width: 50%; text-align: right; padding: 15px;"><!--{{$cart->amount}} * {{$cart->price}} zł = -->{{$cart->totalCost}} zł</td>
                                </tr>
                                </tbody>
                            </table>

                        @endforeach
                        <div class="cartMakeOrder" style="float: left">
                            Łączny koszt: <span class="fw-bold">{{$totalPrice}} zł</span>
                        </div>

                        <div class="cartMakeOrder" style="float: right;">
                            <a style="display: inline !important;" class="btn btn-outline-success" href="{{ url('submitOrder') }}">Złóż zamówienie</a>
                        </div>
                    @else
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                            <div>
                                Koszyk jest pusty!
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
