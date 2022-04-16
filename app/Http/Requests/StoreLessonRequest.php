<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\In;

/**
 * @property string $title
 * @property string $information
 * @property int $course_id
 * @property int $status
*/
final class StoreLessonRequest extends FormRequest
{
    /** @return array<string, In|string> */
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
