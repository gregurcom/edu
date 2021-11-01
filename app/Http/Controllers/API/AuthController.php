<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccessRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request): Response
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response(['token' => $user->createToken($request->name)->plainTextToken], 201);
    }

    public function login(AccessRequest $request): Response
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return response(['token' => Auth::user()->createToken(Auth::user()->name)->plainTextToken], 200);
        }

        return response('Credentials not match', 401);
    }

    public function logout(): Response
    {
        Auth::user()->tokens()->delete();

        return response(['message' => 'Tokens Revoked'], 200);
    }
}
