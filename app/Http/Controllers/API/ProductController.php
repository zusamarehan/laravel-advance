<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsStore;
use App\Http\Requests\ProductsUpdate;
use App\Products;
use App\Http\Resources\ProductResource as ProductResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
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
     * @param ProductsStore $request
     * @return ProductResource
     * @throws AuthorizationException
     */
    public function store (ProductsStore $request) {

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

    /**
     * @param Products $product
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Products $product) {

        $this->authorize('delete');

        $status = $product->delete();
        if($status) {
            return response()
                ->json(['msg' => 'Product Delete Successfully', 'status' => true]);
        }

        return response()
            ->json(['msg' => 'Oops! Something went wrong!', 'status' => false]);
    }


    /**
     * @param Products $product
     * @param ProductsUpdate $request
     * @return ProductResource
     * @throws AuthorizationException
     */
    public function update (Products $product, ProductsUpdate $request) {

        $this->authorize('update', $product);

        $request->merge([
            'updated_by' => auth()->user()->id
        ]);

        $product->update($request->only(['name', 'desc', 'color', 'updated_by']));

        return new ProductResource($product->load('createdBy', 'updatedBy'));

    }

}
