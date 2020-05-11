<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getShoppingCart() {
        $shoppingCartId = Session::get('shoppingCartId');
        return ShoppingCart::findOrCreateBySessionId($shoppingCartId);
    }
}
