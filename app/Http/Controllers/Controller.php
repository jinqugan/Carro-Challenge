<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function createToken(): array
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $expiredAt = Carbon::now()->addDays(30);
        $createToken = $user->createToken('Carro-Challenge', ['*'], $expiredAt);

        return [
            'token' => [
                'id' => $createToken->accessToken->id,
                'type' => 'Bearer',
                'token' => $createToken->plainTextToken,
                'expires_at' => $createToken->accessToken->expires_at,
            ],
        ];
    }
}
