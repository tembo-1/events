<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Services\Api\V1\AuthService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request, AuthService $service):JsonResponse
    {
        $data = $request->validated();

        return response()->json($service->login($data));
    }
}
