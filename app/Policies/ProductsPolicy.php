<?php

namespace App\Policies;

use App\Products;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductsPolicy
{
    use HandlesAuthorization;

    //  1. Read & Write -> rw => 1
    //  2. Read         -> r  => 2
    //  3. Partial Read -> pr => 3


    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the products.
     * To view the Product
     *  - It should be created by the current User
     *  - or The user must have the ability to read it which is denoted by (1 || 2)
     *
     * @param User $user
     * @param Products $products
     * @return mixed
     */
    public function view(User $user, Products $products)
    {
        // if the user has created the product then allow
        if($products->created_by === $user->id) {
            return true;
        }
        // if the user has full read/write then allow
        else if($user->role === 2 || $user->role === 1) {
            return true;
        }

    }

    /**
     * Determine whether the user can create products.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->role === 1;
    }

    /**
     * Determine whether the user can delete the products.
     *
     * @param User $user
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        return $user->role === 1;
    }

    /**
     * Determine whether the user can update product.
     *
     * @param User $user
     * @param Products $products
     * @return bool
     *
     * Allow when ->Product Created by or Has Full Access (Role 1)
     */
    public function update (User $user, Products $products) {

        // if the user has created the product then allow
        return ($products->created_by === $user->id || $user->role === 1);

    }

}
