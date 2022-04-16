<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property string $description
 * @property array $questions
*/
class TestRequest extends FormRequest
{
    /** @return array<string, string> */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable|min:3',
            'questions' => 'required|array',
            'questions.*.title' => 'required|string|max:255',
        ];
    }
}
