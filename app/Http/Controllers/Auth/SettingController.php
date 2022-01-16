<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetPasswordRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(): View
    {
        return view('auth.settings');
    }

    public function modifyPassword(SetPasswordRequest $request): RedirectResponse
    {
        Auth::user()->update(['password' => \Hash::make($request->password)]);

        return back()->with('status', 'You have successfully modified the password');
    }

    public function modifyName(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        Auth::user()->update(['name' => $request->name]);

        return back()->with('status', 'You have successfully modified the name');
    }

    public function modifyAvatar(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = $request->image->hashName();
        $request->image->move(public_path('images'), $imageName);

        Auth::user()->update(['avatar' => $imageName]);

        return back()->with('status', 'You have successfully modified the avatar');
    }
}
