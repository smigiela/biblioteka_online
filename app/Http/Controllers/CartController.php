<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Book;
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
        $inCart = Cart::where('user_id', Auth::user()->id)->where('status', 0)->where('book_id', $request->get("book_id"))->count();
        $inCartAvailable = Book::where('id', $request->get("book_id"))->first('amount');
        if ($inCart < $inCartAvailable->amount) {
            if ($request->amount > 0) {

                $newItem = new Cart;
                $newItem->user_id = $request->get("user_id");
                $newItem->book_id = $request->get("book_id");
                $newItem->authorSurname = $request->get("author_lname");
                $newItem->authorName = $request->get("author_fname");
                $newItem->category = $request->get("category");
                $newItem->amount = $request->get("amount_default");
                $newItem->price = $request->get("price");
                $newItem->status = 0;
                $newItem->totalCost = round($request->get("price") * $request->get("amount_default"), 2);
                $newItem->save();

                return redirect('/cart')->with('messageGreen', 'Pomyślnie dodano do koszyka!');
            } else {
                return redirect('/cart')->with('messageRed', 'Brak dostępnych egzemplarzy!');
            }
        } else {
            return redirect('/cart')->with('messageRed', 'Przekroczono limit dostępnych egzemplarzy! Nie można dodać więcej!');
        }
    }
}
