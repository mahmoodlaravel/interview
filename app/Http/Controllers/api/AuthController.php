<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $pass = Hash::make($request->input('password'));
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => $pass
            ]);
            $token =  $user->createToken('MyApp')->accessToken;
            return response()->json([
                'success' => true,
                'message' => 'You registered successfully!',
                'data' => ['token' => $token]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => null,
            ], 400);
        }
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->input('email'))->first();
        if (!Hash::check($request->input('password'),$user->password))
        {
            return response()->json([
                'success'=>'fail',
                'message'=>'رمز عبور اشتباه است',
                'data'=>null
            ],401);
        }
        $userTokens = $user->tokens;
        foreach($userTokens as $token) {
            $token->revoke();
        }
        $token = $user->createToken('local')->accessToken;
        return response()->json([
            'success' => true,
            'message' => 'You\'ve logged in successfully!',
            'data' => ['token' => $token]
        ]);
    }
}
