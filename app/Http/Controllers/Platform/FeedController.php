<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Contracts\View\View;

class FeedController extends Controller
{
    public function index(): View
    {
        $courses = Course::paginate(20);

        return view('platform.feed', compact('courses'));
    }
}
