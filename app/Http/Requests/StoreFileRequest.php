<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * @property UploadedFile $files
*/
final class StoreFileRequest extends FormRequest
{
    /** @return array<string, string> */
    public function rules(): array
    {
        return [
            'files' => 'nullable|max:2048',
        ];
    }
}
