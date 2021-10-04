<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function download(File $file): StreamedResponse
    {
        return Storage::download($file->path, $file->name);
    }
}
