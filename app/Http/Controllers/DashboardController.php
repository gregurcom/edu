<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(): View
    {
        if (Auth::user()->isAdmin()) {
            $categories = Category::paginate(10);

            return view('system.dashboard', compact('categories'));
        }

        $courses = Auth::user()->courses;

        return view('platform.dashboard', compact('courses'));
    }
}
