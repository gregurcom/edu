<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'information' => 'required',
            'course_id' => 'required|integer',
            'status' => Rule::in([0, 1]),
        ];
    }
}
