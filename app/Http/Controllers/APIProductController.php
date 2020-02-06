<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProducts;
use App\Products;
use App\Http\Resources\ProductResource as ProductResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class APIProductController extends Controller
{
    /**
     * Returns all the Products with Pagination
     *
     * @return AnonymousResourceCollection
     */
    public function index () {

        return ProductResource::collection(Products::with('createdBy', 'updatedBy')->paginate());

    }

    /**
     * Returns a single product requested
     *
     * @param Products $product
     * @return ProductResource
     */
    public function show (Products $product) {

        return new ProductResource($product->load('createdBy', 'updatedBy'));

    }

    /**
     * Creates a new product when the user is authorized
     *
     * @param StoreProducts $request
     * @return ProductResource
     * @throws AuthorizationException
     */
    public function store (StoreProducts $request) {

        $this->authorize('create');

        $product = new Products;

        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->color = $request->color;
        $product->amount = $request->amount;
        $product->created_by = auth()->user()->id;

        $product->save();

        return new ProductResource(Products::with('createdBy', 'updatedBy')->find($product->id));
    }
}
