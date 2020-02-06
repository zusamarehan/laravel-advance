<?php

namespace App\Events;

use App\Products;
;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product;

    /**
     * Create a new event instance.
     *
     * @param Products $product
     */
    public function __construct(Products $product)
    {
        //
        $this->product = $product;
    }

}
