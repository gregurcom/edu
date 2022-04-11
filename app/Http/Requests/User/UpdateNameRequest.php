<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateNameRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }
}
