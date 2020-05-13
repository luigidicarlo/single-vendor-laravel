<?php

namespace App\Http\Controllers;

use App\PayPal;
use App\ShoppingCart;

class ShoppingCartsController extends Controller
{
    public function index()
    {
        $shoppingCart = $this->getShoppingCart();
        $products = $shoppingCart->products()->get();
        $total = $shoppingCart->total();
        $data = compact(['products', 'total']);
        return view('shopping-carts.index', $data);
    }

    public function payment()
    {
        $shoppingCart = $this->getShoppingCart();
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
