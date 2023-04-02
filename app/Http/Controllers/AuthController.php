<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('token-name')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return $this->error('No autorizado', 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        return $this->success('Sesión cerrada correctamente');
    }
}
