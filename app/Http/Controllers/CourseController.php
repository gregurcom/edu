<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
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

    public function edit(Course $course, CourseRequest $request)
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
