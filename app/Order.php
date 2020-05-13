<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    protected $fillable = ['email', 'total', 'shopping_cart_id'];

    public static function createFromPaypalResponse($response, $shoppingCart)
    {
        $email = Auth::user()->email;
        $total = round($response['PAYMENTINFO_0_AMT'], 2);
        $cartId = $shoppingCart->id;

        return Order::create([
            'email' => $email,
            'total' => $total,
            'shopping_cart_id' => $cartId
        ]);
    }

    public static function totalMonth()
    {
        return Order::monthly()->sum('total');
    }

    public static function totalMonthCount()
    {
        return Order::monthly()->count();
    }

    public function scopeLatest($query)
    {
        return $query->orderId()->monthly();
    }

    public function scopeOrderId($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeMonthly($query)
    {
        return $query->whereMonth('created_at', '=', date('m'));
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'created':
                return 'Creado';
                break;
            case 'sent':
                return 'Enviado';
                break;
            case 'received':
                return 'Recibido';
                break;
        }
    }
}
