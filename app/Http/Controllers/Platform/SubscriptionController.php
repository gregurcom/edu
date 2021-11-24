<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index(): View
    {
        $courses = Auth::user()->subscriptions()->with(['author', 'rates'])->get();

        return view('platform.subscriptions', compact('courses'));
    }

    public function store(Course $course): RedirectResponse
    {
        CourseUser::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return back()
            ->with('status', __('app.alert.subscribe'));
    }

    public function destroy(Course $course): RedirectResponse
    {
        CourseUser::where('user_id', Auth::id())->where('course_id', $course->id)->delete();

        return back()->with('status', __('app.alert.unsubscribe'));
    }
}
