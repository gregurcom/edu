<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Requests\LessonRequest;
use App\Jobs\SendLessonEmailJob;
use App\Models\Course;
use App\Models\File;
use App\Models\Lesson;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function create(Request $request): View
    {
        $course = Course::findOrFail($request->course_id);

        return view('platform.course.lesson.create', compact('course'));
    }

    public function store(LessonRequest $lessonRequest, FileRequest $fileRequest): RedirectResponse
    {
        $course = Course::findOrFail($lessonRequest->course_id);

        $lesson = Lesson::create($lessonRequest->validated());

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
        // send emails to subscribers with a link to lesson
        foreach ($course->users as $user) {
            dispatch(new SendLessonEmailJob($user->email, $lesson, $course->title));
        }

        return redirect()->route('platform.courses.show', $course->id)->with('status', 'You have successfully created a lesson.');
    }

    public function show(Lesson $lesson): View
    {
        Str::macro('readDuration', function(...$text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int) max(1, $minutesToRead);
        });
        $readDuration = Str::readDuration($lesson->information) . ' min read';

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

        return redirect()->route('platform.courses.show', $lesson->course)->with('status', 'You have successfully edited lesson');
    }

    public function destroy(Lesson $lesson): RedirectResponse
    {
        $this->authorize('destroy', $lesson);
        $lesson->delete();

        return back()->with('status', 'You have successfully deleted lesson');
    }
}
