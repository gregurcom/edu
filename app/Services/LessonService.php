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
            $name = $file->getClientOriginalName();
            File::create([
                'name' => $name,
                'path' => $file->path(),
                'lesson_id' => $lesson->id,
            ]);

            Storage::disk('s3')->put($file->path(), $file->getContent(), 'private');
        }
    }

    public function getReadDuration(Lesson $lesson): string
    {
        Str::macro('readDuration', function(...$text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int) max(1, $minutesToRead);
        });

        return Str::readDuration($lesson->information) . ' min read';
    }
}
