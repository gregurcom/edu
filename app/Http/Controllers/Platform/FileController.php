<?php

declare(strict_types=1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class FileController extends Controller
{
    public function __invoke(File $file): StreamedResponse
    {
        $course = str_replace(' ', '', $file->lesson->course->title);
        $path = "$course/$file->name";

        return Storage::disk('s3')->download($path);
    }
}
