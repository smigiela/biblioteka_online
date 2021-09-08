<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * @return Collection
     */
    public function index():Collection
    {
        return Cart::with('user')
            ->with('book')
            ->get();
    }

    /**
     * @param CartRequest $request
     *
     * @return Cart
     */
    public function store(CartRequest $request):Cart
    {
        $newItem = new Cart;
        $newItem->user_id = $request->get("user_id");
        $newItem->book_id = $request->get("book_id");
        $newItem->amount = $request->get("amount");
        $newItem->price = $request->get("price");
        $newItem->totalCost = round($request->get("price") * $request->get("amount"), 2);
        $newItem->save();

        return $newItem;
    }

    /**
     * @param Cart $author
     *
     * @return Cart
     */
    public function show(Cart $cart):Cart
    {
        $var = Cart::findOrFail($cart['id'])
            ->with('user')
            ->with('book')
            ->where('id', $cart['id'])
            ->first();
        return $var;
    }

    /**
     * @param CartRequest $request
     * @param Cart $author
     *
     * @return Cart
     */
    public function update(CartRequest $request, Cart $cart):Cart
    {
        $newItem = Cart::find($cart['id']);
        $newItem->update($request->all());
        $newItem->totalCost = round($request->get("price") * $request->get("amount"), 2);
        return $newItem;
    }

    /**
     * @param Cart $author
     *
     * @return Cart
     */
    public function destroy(Cart $cart):String
    {
        if (Cart::find($cart['id'])) {
            Cart::destroy($cart['id']);
            return "Pomyślnie usunięto autora (ID: " . $cart['id'] . ")";
        } else {
            return "Author (ID: " . $cart['id'] . ") nie istnieje";
        }
    }
}
