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

    public function generateCustomId()
    {
        return md5("$this->id $this->updated_at");
    }

    public function updateCustomIdAndStatus()
    {
        $this->status = 'approved';
        $this->customid = $this->generateCustomId();
        $this->save();
    }

    public function approve()
    {
        $this->updateCustomIdAndStatus();
    }

    public function order()
    {
        return $this->hasOne('App\Order')->first();
    }
}
