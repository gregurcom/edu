<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccessRequest;
use App\Services\AttemptService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function __construct(public AttemptService $attemptService) {}

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(AccessRequest $request): RedirectResponse
    {
        if ($this->attemptService->exhaustedAttempts(count($this->attemptService->get($request)), $request)) {
            if (Auth::attempt($request->validated())) {
                $request->session()->regenerate();

                return redirect()->route('dashboard');
            }

            return back()->withErrors([
                'email' => __('app.alert.auth-fail'),
            ]);
        }

        return back()->with('status', 'Your attempts was exhausted');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
