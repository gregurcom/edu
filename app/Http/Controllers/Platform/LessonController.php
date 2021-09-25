<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\File;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LessonController extends Controller
{
    public function show(Lesson $lesson): View
    {
        return view('platform.course.lesson.index', compact('lesson'));
    }

    public function createForm(Course $course): View
    {
        return view('platform.course.lesson.creation', compact('course'));
    }

    public function create(LessonRequest $lessonRequest, FileRequest $fileRequest, Course $course): RedirectResponse
    {
        $lesson = Lesson::create([
            'title' => $lessonRequest->title,
            'information' => $lessonRequest->information,
            'course_id' => $course->id,
        ]);

        if ($fileRequest->hasFile('files')) {
            foreach ($fileRequest->file('files') as $file) {
                $name = $file->getClientOriginalName();

                File::create([
                    'name' => $name,
                    'path' => $file->path(),
                    'lesson_id' => $lesson->id,
                ]);
            }
        }

        return redirect()->route('platform.course.show', $course->id)->with('status', 'You have successfully create lesson');
    }

    public function editForm(Lesson $lesson): View
    {
        $this->authorize('view', $lesson);

        return view('platform.course.lesson.edit', compact('lesson'));
    }

    public function edit(Lesson $lesson, LessonRequest $request): RedirectResponse
    {
        $this->authorize('edit', $lesson);
        $lesson->update($request->validated());

        return redirect()->route('platform.course.show', $lesson->course)->with('status', 'You have successfully edit lesson');
    }

    public function delete(Lesson $lesson): RedirectResponse
    {
        $this->authorize('delete', $lesson);
        $lesson->delete();

        return back()->with('status', 'You have successfully delete lesson');
    }
}
