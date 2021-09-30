<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function registration(): View
    {
        return view('auth.registration');
    }

    public function save(RegistrationRequest $request): RedirectResponse
    {
        $user = User::where('registration_token', $request->token)->firstOrFail();
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => User::USER_ROLE,
            'registration_token' => null,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'You have successfully registered on platform');
    }
}
