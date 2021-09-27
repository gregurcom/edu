<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(): View
    {
        if (Auth::user()->isSystemAdmin()) {
            $categories = Category::get();

            return view('system.dashboard', compact('categories'));
        }

        $courses = Auth::user()->courses;

        return view('platform.dashboard', compact('courses'));
    }
}
