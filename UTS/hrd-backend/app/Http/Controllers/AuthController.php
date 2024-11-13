<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($input);
        $data = [
            "message" => 'user registration',
        ];
        return response()->json($data, 201);
    }

    public function login(Request $request)
    {
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($input)) {
            $token = Auth::user()->createToken('auth_token');
            $data = [
                "message" => 'login success',
                "token" => $token->plainTextToken
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Username or Password incorrect',
            ];
            return response()->json($data, 401);
        }
    }
}
