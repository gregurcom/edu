<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechSupportRequest;
use App\Mail\TechSupportMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class TechSupportController extends Controller
{
    public function show(): View
    {
        return view('platform.tech-support');
    }

    public function send(TechSupportRequest $request): RedirectResponse
    {
        $admin = User::where('role', User::ADMIN_ROLE)->firstOrFail();
        Mail::to($admin->email)->send(new TechSupportMail($request->text));

        return redirect()->route('dashboard')->with('status', __('app.alert.tech-support'));
    }
}
