<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\CheckPassword;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $old_password
 * @property string $password
*/
final class SetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string', 'min:6', new CheckPassword()],
            'password' => 'required|string|confirmed|min:6|max:255',
        ];
    }
}
