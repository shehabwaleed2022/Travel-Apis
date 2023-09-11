<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreSessionRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function store(StoreSessionRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Auth::attempt($request->validated())) {
            return ApiResponse::send(JsonResponse::HTTP_UNPROCESSABLE_ENTITY, 'User credentials does not works.');
        }

        $device = substr($request->userAgent() ?? '', 0, 255);
        $userToken = $user->createToken($device)->plainTextToken;

        return ApiResponse::send(JsonResponse::HTTP_OK, 'User loged in successfully.', ['token' => $userToken]);
    }
}
