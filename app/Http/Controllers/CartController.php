<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('user')
            ->with('book')
            ->where('user_id', Auth::user()->id)
            ->where('status', '==', '0')
            ->get();

        $totalPrice = Cart::where('user_id', Auth::user()->id)->where('status', '==', '0')->sum('totalCost') ?? null;

        return view('cart', ['cart' => $cart, 'totalPrice' => $totalPrice]);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect('/cart')->with('messageRed', 'Pomyślnie usunięto z koszyka!');
    }

    public function store(Request $request)
    {
        if ($request->amount > 0) {
            $newItem = new Cart;

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
                $newItem->order_id = ++$number;
            } else {
                $number = 0;
                $newItem->order_id = ++$number;
            }

            $newItem->user_id = $request->get("user_id");
            $newItem->book_id = $request->get("book_id");
            $newItem->authorSurname = $request->get("author_lname");
            $newItem->authorName = $request->get("author_fname");
            $newItem->category = $request->get("category");
            $newItem->amount = $request->get("amount_default");
            $newItem->price = $request->get("price");
            $newItem->status = 0;
            $newItem->totalCost = round($request->get("price") * $request->get("amount"), 2);
            $newItem->save();

            return redirect('/cart')->with('messageGreen', 'Pomyślnie dodano do koszyka!');
        } else {
            return redirect('/cart')->with('messageRed', 'Brak dostępnych egzemplarzy!');
        }

    }
}
