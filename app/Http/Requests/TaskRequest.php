<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

/**
 * @property string $title
 * @property string $description
 * @property Date $end_time
*/
final class TaskRequest extends FormRequest
{
    /** @return array<string, string> */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|min:5',
            'end_time' => 'nullable|after:' . date('Y-m-d'),
        ];
    }
}
