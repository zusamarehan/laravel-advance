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
        $viewable = Gate::allows('view', Products::find($this->id));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'color' => $this->color,
            'amount' => $this->when($viewable, $this->amount),
            'available' => $this->available,
            'createdBy' => $this->when($viewable, User::collection($this->whenLoaded('createdBy'))),
            'updatedBy' => $this->when($viewable, User::collection($this->whenLoaded('updatedBy'))),
            'createdAt' => $this->when($viewable, $this->created_at),
            'updatedAt' => $this->when($viewable, $this->updated_at),
        ];
    }
}
