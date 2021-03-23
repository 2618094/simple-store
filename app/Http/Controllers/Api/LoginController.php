<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('me');
    }

    public function login(LoginRequest $request)
    {
        if (! $token = auth()->attempt($request->validated())) {
            throw new AuthenticationException();
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

}
