<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource
     */
    public function getCurrentUser (Request $request) {

        return new UserResource(User::find($request->user()->id));

    }
}
