<?php

namespace App\Http\Resources;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;


class ProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'color' => $this->color,
            'amount' => $this->when($this->resource->viewColumns, $this->amount),
            'available' => $this->when($this->resource->viewColumns, $this->available),
            'createdBy' => $this->when($this->resource->viewColumns, User::collection($this->whenLoaded('createdBy'))),
            'updatedBy' => $this->when($this->resource->viewColumns, User::collection($this->whenLoaded('updatedBy'))),
            'createdAt' => $this->when($this->resource->viewColumns, $this->created_at),
            'updatedAt' => $this->when($this->resource->viewColumns, $this->updated_at),
        ];
    }
}
