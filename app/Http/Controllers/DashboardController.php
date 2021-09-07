<?php

namespace App\Http\Controllers;

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
        return view('catalogOfBooks');
    }
    public function book()
    {
        return view('book');
    }
}
