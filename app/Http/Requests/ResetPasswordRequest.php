<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $token
 * @property string $email
 * @property string $password
*/
final class ResetPasswordRequest extends FormRequest
{
    /** @return array<string, string> */
    public function rules(): array
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
