<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function list(): View
    {
        $courses = Course::paginate(10);

        return view('courses', compact('courses'));
    }

    public function show(Course $course): View
    {
        return view('course.index', compact('course'));
    }

    public function createForm(): View
    {
        return view('course.creation');
    }

    public function create(CourseRequest $request): RedirectResponse
    {
        Course::create(array_merge(['user_id' => Auth::id()], $request->validated()));

        return redirect()->route('dashboard')->with('status', 'You successfully create a course');
    }

    public function editForm(Course $course): View
    {
        $this->authorize('view', $course);

        return view('course.edit', compact('course'));
    }

    public function edit(Course $course, CourseRequest $request): RedirectResponse
    {
        $this->authorize('edit', $course);
        $course->update($request->validated());

        return redirect()->route('dashboard')->with('status', 'You successfully edit a course');
    }

    public function delete(Course $course): RedirectResponse
    {
        $this->authorize('delete', $course);
        $course->delete();

        return back()->with('status', 'You successfully delete course');
    }
}
