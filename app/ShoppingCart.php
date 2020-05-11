<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['status'];

    public function productShoppingCarts()
    {
        return $this->hasMany('App\ProductShoppingCart');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_shopping_carts');
    }

    public function productsSize()
    {
        return $this->products()->count();
    }

    public function total()
    {
        return $this->products()->sum('price');
    }

    public static function findOrCreateBySessionId($shoppingCartId)
    {
        if ($shoppingCartId) {
            return static::findBySession($shoppingCartId);
        } else {
            return static::createShoppingCart();
        }
    }

    public static function findBySession($shoppingCartId)
    {
        return ShoppingCart::find($shoppingCartId);
    }

    public static function createShoppingCart()
    {
        return ShoppingCart::create(['status' => 'incomplete']);
    }
}
