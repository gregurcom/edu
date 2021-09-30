<?php

declare(strict_types = 1);

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistration;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function createForm(): View
    {
        return view('system.user-creation');
    }

    public function create(Request $request): RedirectResponse
    {
        $token = Str::random(16);

        $user = User::create([
            'email' => $request->email,
            'registration_token' => $token,
        ]);

        Mail::to($user->email)->send(new UserRegistration($token));

        return redirect()->route('dashboard')->with('status', 'You have successfully register a user');
    }
}
