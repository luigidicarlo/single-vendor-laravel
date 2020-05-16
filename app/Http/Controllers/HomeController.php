<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home.home');
    }

    /**
     * Shows the welcome page.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $products = Product::latest()->simplePaginate(18);
        return view('home.welcome', compact('products'));
    }
}
