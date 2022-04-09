<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Course\Lesson;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FormTestController extends Controller
{
    public function show(Course $course): JsonResponse
    {
        return response()->json([
            'tests' => [
                $course->tests()->with('questions.responses')->get()
            ]
        ]);
    }

    public function store()
    {
        //
    }

    public function delete()
    {
        //
    }
}
