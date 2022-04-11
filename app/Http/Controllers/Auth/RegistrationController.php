<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\DTO\Factories\CreateUserDtoFactory;
use App\Http\Requests\RegistrationRequest;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class RegistrationController extends Controller
{
    public function registration(): View
    {
        return view('auth.registration');
    }

    public function save(RegistrationRequest $request, UserService $userService): RedirectResponse
    {
        $dto = app(CreateUserDtoFactory::class)->createFromRequest($request);

        $user = $userService->store($dto);
        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('dashboard')->with('status', __('app.alert.email-verification'));
    }
}
