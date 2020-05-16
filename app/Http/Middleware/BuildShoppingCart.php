<?php

namespace App\Http\Middleware;

use App\ShoppingCart;
use Closure;
use Illuminate\Support\Facades\Session;

class BuildShoppingCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $shoppingCartId = Session::get('shoppingCartId');
        $shoppingCart = ShoppingCart::findOrCreateBySessionId($shoppingCartId);
        $request->shoppingCart = $shoppingCart;
        return $next($request);
    }
}
