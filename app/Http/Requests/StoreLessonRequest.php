<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property string $information
 * @property int $course_id
 * @property int $status
*/
final class StoreLessonRequest extends FormRequest
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
