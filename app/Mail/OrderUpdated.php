<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;   
    }

    private function getShoppingCart()
    {
        return $this->order->shoppingCart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $shoppingCart = $this->getShoppingCart();
        return $this->from('lehuertad95@gmail.com', 'KuraiMarket')
            ->view('mail.order-updated', compact(['order', 'shoppingCart']));
    }
}
