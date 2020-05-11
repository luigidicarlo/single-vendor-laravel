<?php

namespace App\Http\Controllers;

use App\PayPal;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
}
