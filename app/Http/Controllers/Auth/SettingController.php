<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAvatarRequest;
use App\Http\Requests\User\UpdateNameRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class SettingController extends Controller
{
    public function index(): View
    {
        return view('auth.settings');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        Auth::user()->update(['password' => \Hash::make($request->password)]);

        return back()->with('status', 'You have successfully modified the password');
    }

    public function updateName(UpdateNameRequest $request): RedirectResponse
    {
        Auth::user()->update(['name' => $request->name]);

        return back()->with('status', 'You have successfully modified the name');
    }

    public function updateAvatar(UpdateAvatarRequest $request): RedirectResponse
    {
        $imageName = $request->image->hashName();
        $request->image->move(public_path('images'), $imageName);

        Auth::user()->update(['avatar' => $imageName]);

        return back()->with('status', 'You have successfully modified the avatar');
    }
}
