<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechSupportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => 'required|min:6'
        ];
    }
}
