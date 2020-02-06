<?php

namespace App;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{


    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => ProductCreated::class,
    ];

    /**
     * Get the CreatedBy for the Product
     */
    public function createdBy()
    {
        return $this->hasMany('App\User', 'id', 'created_by');
    }

    /**
     * Get the UpdatedBy for the Product
     */
    public function updatedBy()
    {
        return $this->hasMany('App\User', 'id', 'updated_by');
    }
}
