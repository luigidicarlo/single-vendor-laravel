<?php

namespace App\Http\Controllers;

use App\PayPal;
use App\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('shoppingCart');
    }

    public function index(Request $request)
    {
        $shoppingCart = $request->shoppingCart;
        $products = $shoppingCart->products()->get();
        $total = $shoppingCart->total();
        $data = compact(['products', 'total']);
        return view('shopping-carts.index', $data);
    }

    public function payment(Request $request)
    {
        $shoppingCart = $request->shoppingCart;
        $paypal = new PayPal($shoppingCart);
        $paypal->requestPayment();
    }

    public function show($id)
    {
        $shoppingCart = ShoppingCart::where('customid', $id)->first();
        $order = $shoppingCart->order();
        $data = compact(['shoppingCart', 'order']);
        return view('shopping-carts.completed', $data);
    }
}
