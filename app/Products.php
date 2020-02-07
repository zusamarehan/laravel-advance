<?php

namespace App;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class Products extends Model
{


    public $viewColumns = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->viewColumns = $this->viewable();
    }

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

    /**
     * @return bool
     */
    public function viewable()
    {
        return Gate::allows('view', $this);
    }
}
