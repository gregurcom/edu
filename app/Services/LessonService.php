<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\DTO\LessonDto;
use App\Http\Requests\StoreFileRequest;
use App\Jobs\SendLessonEmailJob;
use App\Models\File;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Exception\RuntimeException;
use Illuminate\Support\Facades\Storage;

final class LessonService
{
    public function store(LessonDto $dto): Lesson
    {
        return Lesson::create([
            'title' => $dto->title,
            'information' => $dto->information,
            'course_id' => $dto->course_id,
            'status' => $dto->status,
        ]);
    }

    public function sendLessonCreateNotification(Lesson $lesson): void
    {
        $subscribers = $lesson->course->subscribers;
        if ($subscribers !== null) {
            foreach ($subscribers as $subscriber) {
                dispatch(new SendLessonEmailJob($subscriber->email, $lesson, $lesson->course->title));
            }
        }
    }

    public function storeAttachedFiles(Lesson $lesson, StoreFileRequest $fileRequest): void
    {
        try {
            DB::beginTransaction();

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

            DB::commit();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            throw new RuntimeException($throwable->getMessage());
        }
    }
}
