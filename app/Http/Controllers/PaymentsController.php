<?php

namespace App\Http\Controllers;

use App\Order;
use App\PayPal;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('shoppingCart');
    }

    private function executePayment(Request $request, $shoppingCart)
    {
        $paypal = new PayPal($shoppingCart);
        return $paypal->executePayment($request->token, $request->PayerID);
    }

    public function store(Request $request)
    {
        $shoppingCart = $request->shoppingCart;
        $response = $this->executePayment($request, $shoppingCart);
        
        if ($response['ACK'] != 'Success') {
            return redirect(route('cart'));
        }

        $shoppingCart->approve();

        Session::remove('shoppingCartId');

        $created = Order::createFromPaypalResponse($response, $shoppingCart);
        $order = Order::find($created->id);
        $order->sendMail();
        $data = compact(['shoppingCart', 'order']);
        
        return view('shopping-carts.completed', $data);
    }
}
