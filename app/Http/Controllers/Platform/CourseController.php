<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function list(): View
    {
        $categories = Category::paginate(10);

        return view('platform.courses', compact('categories'));
    }

    public function followed(): View
    {
        $courses = Auth::user()->subscriptions;

        return view('platform.courses-followed', compact('courses'));
    }

    public function search(Request $request): View
    {
        $courses = Course::where('title', 'like', '%' . $request->q . '%')->paginate(10);

        return view('platform.course.search', compact('courses'));
    }

    public function show(Course $course): View
    {
        return view('platform.course.index', compact('course'));
    }

    public function createForm(): View
    {
        $categories = Category::get();

        return view('platform.course.creation', compact('categories'));
    }

    public function create(CourseRequest $request): RedirectResponse
    {
        Course::create(array_merge(['user_id' => Auth::id()], $request->validated()));

        return redirect()->route('dashboard')->with('status', 'You have successfully created a course');
    }

    public function editForm(Course $course): View
    {
        $this->authorize('view', $course);

        return view('platform.course.edit', compact('course'));
    }

    public function edit(Course $course, CourseRequest $request): RedirectResponse
    {
        $this->authorize('edit', $course);
        $course->update($request->validated());

        return redirect()->route('dashboard')->with('status', 'You have successfully edited course');
    }

    public function delete(Course $course): RedirectResponse
    {
        $this->authorize('delete', $course);
        $course->delete();

        return back()->with('status', 'You have successfully deleted course');
    }

    public function follow(Course $course): RedirectResponse
    {
        CourseUser::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return back()
            ->with('status', 'You have successfully followed this course.Now you will receive a notification about the new release of the lesson to your mail');
    }

    public function unfollow(Course $course): RedirectResponse
    {
        CourseUser::where('user_id', Auth::id())->where('course_id', $course->id)->delete();

        return back()->with('status', 'You have successfully unfollowed this course');
    }
}
