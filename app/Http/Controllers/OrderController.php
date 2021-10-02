<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laratrust\Laratrust;

class OrderController extends Controller
{
    public function index()
    {
        $admin = User::where('id', Auth::user()->id)->where('name', 'Administrator')->first() ?? null;

        if ($admin) {
            $order = Order::with('carts')
                ->get();

        } else
            $order = Order::with('carts')
                ->where('user_id', Auth::user()->id)
                ->get();
        return view('order', ['order' => $order]);
    }

    public function adminOrder()
    {
        $order = Order::with('carts')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('order', ['order' => $order]);
    }

    public function submitOrder()
    {
        $newItem = new Order;

        $dt = Carbon::parse();
        $actualMonth = $dt->month; //symulacja miesiecy
        $actualYear = $dt->year; //symulacja lat
        $lastUsedMonth = Order::latest('month')->pluck('month')->first();
        $lastUsedYear = Order::latest('year')->pluck('year')->first();

        if ($actualMonth == $lastUsedMonth || $actualYear == $lastUsedYear) { //jeśli miesiac i rok z ostatniego rekordu w bazie sa równe obecnemu miesiacowi i rokowi to tworzy nowy numer umowy z tym samym miesiacem i rokiem

            $maxNumber = Order::where('month', $actualMonth)
                ->where('year', $actualYear)
                ->max('number');

            if ($maxNumber) {
                $number = $maxNumber;
            } else {
                $number = 0;
            }

            $newItem->number = ++$number; // zwiększenie numeru o jeden
        } else {
            $number = 0;
            $newItem->number = ++$number; // zwiększenie numeru o jeden
        }

        $newItem->month = $actualMonth; //aktualny miesiac
        $newItem->year = $actualYear; //aktualny rok
        $newItem->orderNumber = "FAV/" . $number . "/" . $actualMonth . "/" . $actualYear; //pełna nazwa
        $newItem->user_id = Auth::user()->id;
        $newItem->save();


        $var = Cart::where('user_id', Auth::user()->id)
            ->chunkById(200, function ($status) {
                $status->each->update(['status' => 1]);
            }, $column = 'id');

        return redirect('/cart')->with('messageGreen', 'Pomyślnie złożono zamówienie!');
    }

    public function detailOrder($id)
    {
        $user = Order::where('id', $id)->where('user_id', Auth::user()->id)->first() ?? null;

        if (Auth::user()->hasRole('admin'))
        {
            $orderDetail = Order::with('carts')
                ->where('id', $id)
                ->get();

            $dt = Carbon::parse();

            $totalPrice = Cart::where('order_id', $id)->sum('totalCost') ?? null;

            return view('orderDetail', ['orderDetail' => $orderDetail, 'dt' => $dt, 'totalPrice' => $totalPrice]);
        }
        elseif ($user)
        {
            $orderDetail = Order::with('carts')
                ->where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->get();
            $dt = Carbon::parse();

            $totalPrice = Cart::where('user_id', Auth::user()->id)->where('order_id', $id)->sum('totalCost') ?? null;

            return view('orderDetail', ['orderDetail' => $orderDetail, 'dt' => $dt, 'totalPrice' => $totalPrice]);

        } else {
            return redirect('/order')->with('messageRed', 'Brak uprawnień do wykonania tej czynności!');
        }

    }
}
