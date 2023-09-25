<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Api\V1\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * @param  RegisterRequest  $request
     * @param  AuthService  $service
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, AuthService $service):JsonResponse
    {
        $data = $request->validated();

        return response()->json($service->register($data));
    }
}
