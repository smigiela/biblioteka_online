<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('user')
            ->with('book')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('cart', ['cart' => $cart]);
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect('/cart')->with('messageRed', 'Pomyślnie usunięto z koszyka!');;
    }

    public function store(Request $request)
    {
        $newItem = new Cart;
        $newItem->user_id = $request->get("user_id");
        $newItem->book_id = $request->get("book_id");
        $newItem->amount = $request->get("amount");
        $newItem->price = $request->get("price");
        $newItem->totalCost = round($request->get("price") * $request->get("amount"), 2);
        $newItem->save();

        return redirect('/cart')->with('messageGreen', 'Pomyślnie dodano do koszyka!');;
    }

    public function submitOrder()
    {
        $var = Cart::where('user_id', Auth::user()->id)
        ->chunkById(200, function ($flights) {
            $flights->each->update(['amount' => Cart::latest('id')->pluck('id')->first() + 1]);
        }, $column = 'id');


        return $var;
    }
}
