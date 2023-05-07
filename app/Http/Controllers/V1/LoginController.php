<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Resources\User\UserResource;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        return (new UserResource($request->user()))->additional([
            'meta' => $this->createToken(),
        ]);
    }
}
