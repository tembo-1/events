<?php

namespace App\Services\Api\V1;

use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * @param  array  $data
     * @return Collection
     */
    public function register(array $data):Collection
    {
        try {
            return collect(['error' => null, 'result' => User::create($data)]);
        }
        catch (Exception $exception) {
            return collect(['error' => $exception->getCode(), 'message' => $exception->getMessage()]);
        }
    }

    /**
     * @param  array  $data
     * @return Collection
     */
    public function login(array $data):Collection
    {
        if (Auth::attempt($data)) {
            $token = auth()->user()->createToken('auth-token');

            return collect(['error' => null, 'token' => $token->plainTextToken]);
        }

        return collect(['error' => 403, 'message' => 'Invalid credentials']);
    }
}
