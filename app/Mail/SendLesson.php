<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLesson extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lesson $lesson, public string $courseTitle) {}

    public function build(): self
    {
        return $this->subject('New lesson!')->view('mail.lesson');
    }
}
