<?php

declare(strict_types = 1);

namespace App\Services;

use App\Http\Requests\FileRequest;
use App\Jobs\SendLessonEmailJob;
use App\Models\File;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LessonService
{
    public function sendLessonCreateNotification(Lesson $lesson): void
    {
        foreach ($lesson->course->users as $user) {
            dispatch(new SendLessonEmailJob($user->email, $lesson, $lesson->course->title));
        }
    }

    public function storeAttachedFiles(Lesson $lesson, FileRequest $fileRequest): void
    {
        foreach ($fileRequest->file('files') as $file) {
            $course = str_replace(' ', '', $lesson->course->title);
            $name = $file->getClientOriginalName();
            $path = $file->storeAs($course, $name, 's3');

            File::create([
                'name' => $name,
                'path' => Storage::disk('s3')->url($path),
                'lesson_id' => $lesson->id,
            ]);
        }
    }
}
