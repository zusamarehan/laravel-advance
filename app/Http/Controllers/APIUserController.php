<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;

class APIUserController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource
     */
    public function getCurrentUser (Request $request) {

        return new UserResource(User::find($request->user()->id));

    }
}
