<?php

namespace App\Providers;

use App\ShoppingCart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class ShoppingCartProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $shoppingCartId = Session::get('shoppingCartId');
            $shoppingCart = ShoppingCart::findOrCreateBySessionId($shoppingCartId);
            Session::put('shoppingCartId', $shoppingCart->id);
            $view->with('productsSize', $shoppingCart->productsSize());
        });
    }
}
