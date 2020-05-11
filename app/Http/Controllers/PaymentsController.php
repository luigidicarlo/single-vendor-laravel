<?php

namespace App\Http\Controllers;

use App\Order;
use App\PayPal;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentsController extends Controller
{
    private function executePayment(Request $request, $shoppingCart)
    {
        $paypal = new PayPal($shoppingCart);
        return $paypal->executePayment($request->token, $request->PayerID);
    }

    public function store(Request $request)
    {
        $shoppingCart = $this->getShoppingCart();
        $response = $this->executePayment($request, $shoppingCart);
        
        if ($response['ACK'] != 'Success') {
            return redirect(route('cart'));
        }

        $details = Order::createFromPaypalResponse($response, $shoppingCart);
        $data = compact(['shoppingCart', 'details']);
        
        return view('shopping-carts.completed', $data);
    }
}
