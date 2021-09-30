<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $token) {}

    public function build(): self
    {
        return $this->subject('Mentor - registration an account')->view('mail.user-registration');
    }
}
