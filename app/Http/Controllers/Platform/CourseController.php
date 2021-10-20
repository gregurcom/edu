<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(): View
    {
        $categories = Category::with('courses')->paginate(10);

        return view('platform.courses', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::get();

        return view('platform.course.create', compact('categories'));
    }

    public function store(CourseRequest $request): RedirectResponse
    {
        Course::create(array_merge(['user_id' => Auth::id()], $request->validated()));

        return redirect()->route('dashboard')->with('status', 'You have successfully created a course');
    }

    public function show(Course $course): View
    {
        return view('platform.course.index', compact('course'));
    }

    public function edit(Course $course): View
    {
        $this->authorize('view', $course);
        $categories = Category::get();

        return view('platform.course.edit', compact(['course', 'categories']));
    }

    public function update(Course $course, CourseRequest $request): RedirectResponse
    {
        $this->authorize('update', $course);
        $course->update($request->validated());

        return redirect()->route('dashboard')->with('status', 'You have successfully edited course');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $this->authorize('destroy', $course);
        $course->delete();

        return back()->with('status', 'You have successfully deleted course');
    }

    public function search(SearchRequest $request, CourseService $courseService): View
    {
        $courses = $courseService->searchCourse($request);

        return view('platform.course.search', compact('courses'));
    }
}
