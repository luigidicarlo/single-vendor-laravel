<?php

namespace App;

use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPal
{
    private $provider;
    private $data = [];

    public function __construct($shoppingCart)
    {
        $products = $shoppingCart->products()->get();
        $this->setItems($products);
        $this->data['total'] = $shoppingCart->total();
        $this->data['return_url'] = env('PAYPAL_RETURN_URL');
        $this->data['cancel_url'] = env('PAYPAL_CANCEL_URL');
        $this->data['invoice_id'] = uniqid();
        $this->data['invoice_description'] = 'Tu orden de compra en '.env('APP_NAME');
        $this->provider = new ExpressCheckout;
    }

    private function setItems($products = []) {
        $this->data['items'] = [];
        foreach ($products as $product) {
            array_push($this->data['items'], [
                'name' => $product->name,
                'price' => $product->price,
                'desc' => $product->description,
                'qty' => 1
            ]);
        }
    }

    public function requestPayment()
    {
        $response = $this->provider->setExpressCheckout($this->data);
        $redirectUrl = (string) $response['paypal_link'];
        return redirect()->to($redirectUrl)->send();
    }

    public function executePayment($token, $payerId)
    {
        $response = $this->provider->doExpressCheckoutPayment($this->data, $token, $payerId);
        return $response;
    }
}