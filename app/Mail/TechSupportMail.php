<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TechSupportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $text) {}

    public function build(): self
    {
        return $this->subject('Mentor - tech support')->view('mail.tech-support');
    }
}
