<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class VerifyUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->token) {
            $user = User::where('registration_token', $request->token)->first();

            if ($user) {
                return $next($request);
            }
        }

        return redirect()->route('auth.login');
    }
}
