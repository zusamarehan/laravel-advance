<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\UserProducts;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementUserProduct
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreated  $event
     * @return void
     */
    public function handle(ProductCreated $event)
    {
        $existing = UserProducts::where('user_id', '=', $event->product->created_by)->first();

        if($existing) {
            $existing->increment('product_created');
        }
        else {
            $userProduct = new UserProducts;

            $userProduct->user_id = $event->product->created_by;
            $userProduct->product_created = 1;

            $userProduct->save();
        }

    }
}
