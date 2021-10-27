<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        if (Auth::user()->hasRole('admin')) {
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
        dd(Order::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES"));
        $cart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->pluck('book_id');
        $inCart = $cart->countBy()->all();

        foreach ($inCart as $keyBookId => $count) {
            $actualBook = Book::find($keyBookId);
            if ($actualBook->amount >= $count) {
                continue;
            }
            return redirect('/cart')->with('messageRed', 'Nieprawidłowa ilość egzemplarzy w koszyku!');
        }

        $newItem = new Order;

        $actualCart = Cart::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->chunkById(200, function ($status) {
                $lastIdOfOrders = Order::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES");
//        dd($lastIdOfOrders);
                $status->each->update(['order_id' => $lastIdOfOrders]);
                $status->each->update(['status' => 1]);
            }, $column = 'id');;

//            przedmiot znika z koszyka, bo status sie zmienia. Dodatkowo nowe zamowienie ma juz swoje pozycje z koszyka
//        dd($actualCart);

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

            $newItem->number = ++$number;
        } else {
            $number = 0;
            $newItem->number = ++$number;
        }
        $newItem->month = $actualMonth;
        $newItem->year = $actualYear;
        $newItem->orderNumber = "FAV/" . $number . "/" . $actualMonth . "/" . $actualYear; //pełna nazwa
        $newItem->user_id = Auth::user()->id;
        $newItem->save();

        //poprawic
        $books_id = Cart::where('user_id', Auth::user()->id)
            ->where('status', 1)
            ->where('order_id', Order::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES")) //lub -1
            ->pluck('book_id');

        $bookCounts = $books_id->countBy()->all();

        foreach ($bookCounts as $book => $count) {
            $borrowedBook = Book::find($book);
            $borrowedBook->decrement('amount', $count);
        }
        return redirect('/cart')->with('messageGreen', 'Pomyślnie złożono zamówienie!');
    }

    public function detailOrder($id)
    {
        $user = Order::where('id', $id)->where('user_id', Auth::user()->id)->first() ?? null;

        if (Auth::user()->hasRole('admin')) {
            $orderDetail = Order::with('carts')
                ->where('id', $id)
                ->get();

            $dt = Carbon::parse();

            $totalPrice = Cart::where('order_id', $id)->sum('totalCost') ?? null;

            return view('orderDetail', ['orderDetail' => $orderDetail, 'dt' => $dt, 'totalPrice' => $totalPrice]);
        } elseif ($user) {
            $orderDetail = Order::with('carts')
                ->where('user_id', Auth::user()->id)
                ->where('id', $id)
                ->get();
            $dt = Carbon::parse();

            $totalPrice = Cart::where('user_id', Auth::user()->id)->where('order_id', $id)->sum('totalCost') ?? null;

            return view('orderDetail', ['orderDetail' => $orderDetail, 'dt' => $dt, 'totalPrice' => $totalPrice]);

        } else {
            abort(403, 'Brak uprawnień');
        }

    }
}
