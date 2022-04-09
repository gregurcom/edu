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
    public function rules(): array
    {
        return [
            'files' => 'nullable|max:2048',
        ];
    }
}
