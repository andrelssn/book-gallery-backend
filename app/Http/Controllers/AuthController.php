<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors()
            ], 422));
        }

        $validated = $validator->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json([
            'ok' => true,
            'user' => $user,
        ]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'errors' => $validator->errors()
            ], 422));
        }

        $validated = $validator->validated();

        if (Auth::attempt($validated)) {
            $user = User::where('email', $validated['email'])->first();

            $token = $user->createToken('api-token', ['post:read', 'post:create'])->plainTextToken;

            return response()->json([
                'ok' => true,
                't' => $token,
            ]);
        }

        return response()->json([
            'ok' => false,
            'message' => "Invalid Credentials",
        ], 401);

    }

    public function logout(Request $request) {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'ok' => false,
                'message' => "Missing Token",
            ], 400);
        };

        $access_token = PersonalAccessToken::findToken($token);

        if (!$access_token) {
            return response()->json([
                'ok' => false,
                'message' => "Invalid Token",
            ], 400);
        };

        $access_token->delete();

        return response()->json([
            'ok' => true,
            'message' => "Logout completed",
        ]);
    }
}
