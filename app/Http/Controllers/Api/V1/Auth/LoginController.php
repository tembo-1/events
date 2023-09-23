<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request):JsonResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $token = auth()->user()->createToken('auth-token');

            return response()->json(['error' => null, 'token' => $token->plainTextToken]);
        }

        return response()->json(['error' => 403, 'message' => 'Invalid credentials']);
    }
}
