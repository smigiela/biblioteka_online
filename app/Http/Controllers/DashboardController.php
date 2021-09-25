<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('admindashboard');
        } else {
            return view('userdashboard');
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

}
