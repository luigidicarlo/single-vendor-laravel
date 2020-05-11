<?php

namespace App\Http\Controllers;

use App\ProductShoppingCart;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductShoppingCartsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shoppingCartId = Session::get('shoppingCartId');
        $shoppingCart = ShoppingCart::findOrCreateBySessionId($shoppingCartId);
        $result = ProductShoppingCart::create([
            'shopping_cart_id' => $shoppingCart->id,
            'product_id' => $request->product_id
        ]);

        if ($result) {
            return redirect('/cart');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
