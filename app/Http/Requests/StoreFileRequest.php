<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'files' => 'max:2048|nullable',
        ];
    }
}
