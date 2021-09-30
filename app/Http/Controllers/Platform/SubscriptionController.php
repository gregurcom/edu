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
    public function show(): View
    {
        $courses = Auth::user()->subscriptions;

        return view('platform.courses-followed', compact('courses'));
    }

    public function create(Course $course): RedirectResponse
    {
        CourseUser::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return back()
            ->with('status', 'You have successfully followed this course.Now you will receive a notification about the new release of the lesson to your mail');
    }

    public function delete(Course $course): RedirectResponse
    {
        CourseUser::where('user_id', Auth::id())->where('course_id', $course->id)->delete();

        return back()->with('status', 'You have successfully unfollowed this course');
    }
}
