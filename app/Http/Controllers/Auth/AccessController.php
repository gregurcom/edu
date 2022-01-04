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
        if (count($this->attemptService->get($request)) < 3) {
            if (Auth::attempt($request->validated())) {
                $request->session()->regenerate();
                $this->attemptService->remove($request);

                return redirect()->route('dashboard');
            }

            $this->attemptService->store($request);

            if (count($this->attemptService->get($request)) < 3) {
                return back()->withErrors([
                    'email' => __('app.alert.auth-fail'),
                ]);
            }
        }
        $timeout = config('attempts.timeout') - now()->diffInMinutes($this->attemptService->get($request)->last()->created_at);

        return back()->with('status', trans_choice('app.alert.attempts-exhausted', $timeout, ['minute' => $timeout]));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
