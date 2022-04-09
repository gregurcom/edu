<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $searchValue
*/
final class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'searchValue' => 'required',
        ];
    }
}
