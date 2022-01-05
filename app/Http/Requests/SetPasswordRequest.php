<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use App\Rules\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;

class SetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string', 'min:6', new CheckPassword()],
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
