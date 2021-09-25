<?php

namespace App\Jobs;

use App\Mail\SendLesson;
use App\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendLessonEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $userEmail, public Lesson $lesson, public string $course) {}

    public function handle(): void
    {
        $email = new SendLesson($this->lesson, $this->course);
        Mail::to($this->userEmail)->send($email);
    }
}
