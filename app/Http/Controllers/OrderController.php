<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
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
        $lastUsedMonth =  Order::latest('month')->pluck('month')->first();
        $lastUsedYear =  Order::latest('year')->pluck('year')->first();

        if ($actualMonth == $lastUsedMonth || $actualYear == $lastUsedYear){ //jeśli miesiac i rok z ostatniego rekordu w bazie sa równe obecnemu miesiacowi i rokowi to tworzy nowy numer umowy z tym samym miesiacem i rokiem

            $maxNumber = Order::where('month', $actualMonth)
                ->where('year', $actualYear)
                ->max('number');

            if ($maxNumber){
                $number = $maxNumber;
            }else{
                $number = 0;
            }

            $newItem->number = ++$number; // zwiększenie numeru o jeden
        } else
        {
            $number = 0;
            $newItem->number = ++$number; // zwiększenie numeru o jeden
        }

        $newItem->month = $actualMonth; //aktualny miesiac
        $newItem->year = $actualYear; //aktualny rok
        $newItem->orderNumber = $number."/".$actualMonth."/".$actualYear; //pełna nazwa
        $newItem->user_id = Auth::user()->id;
        $newItem->save();


        $var = Cart::where('user_id', Auth::user()->id)
            ->chunkById(200, function ($status) {
                $status->each->update(['status' => 1]);
            }, $column = 'id');

        return redirect('/cart');
    }

    public function detailOrder($id)
    {
        $orderDetail = Order::with('carts')
            ->where('user_id', Auth::user()->id)
            ->where('id', $id)
            ->get();
        return view('orderDetail', ['orderDetail' => $orderDetail]);
    }
}
