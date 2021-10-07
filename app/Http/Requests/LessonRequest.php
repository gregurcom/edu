<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'information' => 'required',
            'course_id' => 'integer',
            'status' => Rule::in([0, 1]),
        ];
    }
}
