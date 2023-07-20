<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'password' => ['Password Salah.']
                ]);
            }

            return response()->json([
                'user' => $user,
                'token' => $user->createToken('laravel_api_token')->plainTextToken
            ]);
        } else {
            throw ValidationException::withMessages([
                'email' => ['Email tidak sesuai silahkan ulangi atau Signup dulu.']
            ]);
        }

    }
}