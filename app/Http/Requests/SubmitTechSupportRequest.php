<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $text
*/
final class SubmitTechSupportRequest extends FormRequest
{
    /** @return array<string, string> */
    public function rules(): array
    {
        return [
            'text' => 'required|min:6'
        ];
    }
}
