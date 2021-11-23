<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLessonRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'course_id' => 'require|integer',
        ];
    }
}
