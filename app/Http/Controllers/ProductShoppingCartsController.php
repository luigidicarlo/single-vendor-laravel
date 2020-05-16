<?php

namespace App\Http\Controllers;

use App\ProductShoppingCart;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductShoppingCartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('shoppingCart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shoppingCart = $request->shoppingCart;
        
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
