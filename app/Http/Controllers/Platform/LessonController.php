<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Services\LessonService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create(Request $request): View
    {
        $course = Course::findOrFail($request->course);

        return view('platform.course.lesson.create', compact('course'));
    }

    public function store(LessonRequest $lessonRequest, FileRequest $fileRequest, LessonService $lessonService): RedirectResponse
    {
        $lesson = Lesson::create($lessonRequest->validated());

        if ($fileRequest->hasFile('files')) {
            $lessonService->storeAttachedFiles($lesson, $fileRequest);
        }
        if ($lessonRequest->status == 1) {
            // send emails to subscribers with a link to lesson
            $lessonService->sendLessonCreateNotification($lesson);
        }

        return redirect()->route('platform.courses.show', $lesson->course->id)->with('status', __('app.alert.create-lesson'));
    }

    public function show(Lesson $lesson, LessonService $lessonService): View
    {
        $readDuration = $lessonService->getReadDuration($lesson);

        return view('platform.course.lesson.index', compact(['lesson', 'readDuration']));
    }

    public function edit(Lesson $lesson): View
    {
        $this->authorize('view', $lesson);

        return view('platform.course.lesson.edit', compact('lesson'));
    }

    public function update(Lesson $lesson, LessonRequest $request): RedirectResponse
    {
        $this->authorize('update', $lesson);
        $lesson->update($request->validated());

        return redirect()->route('platform.courses.show', $lesson->course)->with('status', __('app.alert.edit-lesson'));
    }

    public function destroy(Lesson $lesson): RedirectResponse
    {
        $this->authorize('destroy', $lesson);
        $lesson->delete();

        return back()->with('status', __('app.alert.delete-lesson'));
    }
}
