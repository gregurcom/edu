<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Rules\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;

final class UpdatePasswordRequest extends FormRequest
{
    /** @return array<string, array<int, CheckPassword|string>|string> */
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string', 'min:6', new CheckPassword()],
            'password' => 'required|string|confirmed|min:6|max:255',
        ];
    }
}
