<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    public $order;
    public $products;
    public $shoppingCart;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->shoppingCart = $order->shoppingCart()->first();
        $this->products = $this->shoppingCart->products()->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $shoppingCart = $this->shoppingCart;
        $products = $this->products;
        return $this
            ->from('lehuertad95@gmail.com', 'KuraiMarket')
            ->view('mail.order', compact(['order', 'shoppingCart', 'products']));
    }
}
