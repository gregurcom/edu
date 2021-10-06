<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\CourseUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index(): View
    {
        $courses = Auth::user()->subscriptions()->with('rates', 'author')->get();

        return view('platform.subscriptions', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        CourseUser::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
        ]);

        return back()
            ->with('status', 'You have successfully followed this course.Now you will receive a notification about the new release of the lesson to your mail');
    }

    public function destroy(Request $request): RedirectResponse
    {
        CourseUser::where('user_id', Auth::id())->where('course_id', $request->course_id)->delete();

        return back()->with('status', 'You have successfully unfollowed this course');
    }
}
