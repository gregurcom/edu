<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(): View
    {
        $courses = Auth::user()->courses;

        return view('dashboard', compact('courses'));
    }
}
