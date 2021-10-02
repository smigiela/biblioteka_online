<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $quantityBooks = Cart::where('user_id', Auth::user()->id)->count() ?? null;

        $favoriteBook = Cart::where('user_id', Auth::user()->id)->select('book_id')->groupBy('book_id')->orderByRaw('COUNT(*) DESC')->limit(1)->with('book')->first() ?? null;

        $favoriteAuthor = Cart::where('user_id', Auth::user()->id)->select('authorSurname', 'authorName')->groupBy('authorSurname', 'authorName')->orderByRaw('COUNT(*) DESC')->limit(1)->first() ?? null;

        $favoriteCategory = Cart::where('user_id', Auth::user()->id)->select('category')->groupBy('category')->orderByRaw('COUNT(*) DESC')->limit(1)->first() ?? null;

        $date = Carbon::now()->subDays(30);
        $quantityBooksLastMonth = Cart::where('user_id', Auth::user()->id)->where('updated_at', '>', $date)->count() ?? null;

        if (Auth::user()->hasRole('admin')) {
            return view('admindashboard', ['quantityBooks' => $quantityBooks, 'favoriteBook' => $favoriteBook, 'quantityBooksLastMonth' => $quantityBooksLastMonth, 'favoriteAuthor' => $favoriteAuthor,  'favoriteCategory' => $favoriteCategory]);
        } else {
            return view('userdashboard', ['quantityBooks' => $quantityBooks, 'favoriteBook' => $favoriteBook, 'quantityBooksLastMonth' => $quantityBooksLastMonth, 'favoriteAuthor' => $favoriteAuthor,  'favoriteCategory' => $favoriteCategory]);
        }
    }

    public function catalogOfBooks()
    {
        $books = Book::with('category')
            ->with('author')
            ->get();
        return view('catalogOfBooks', ['books' => $books]);
    }

    public function adminPanel()
    {
        return view('adminPanel');
    }

    public function detailBook($id)
    {
        $book = Book::where('id', $id)->with('author')->with('category')->first();
        return view('bookDetail', ['book' => $book]);
    }

}
