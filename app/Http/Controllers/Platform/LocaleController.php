<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        App::setLocale($request->input('locale'));
        Session::put('locale', $request->input('locale'));

        return redirect()->back();
    }
}
