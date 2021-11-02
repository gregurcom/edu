<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $courses = Auth::user()->courses()->get(['id', 'title', 'description']);

        return view('platform.dashboard', compact('courses'));
    }
}
