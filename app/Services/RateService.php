<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Course;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateService
{
    public function updateRating(Course $course, Request $request): void
    {
        Rate::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'course_id' => $course->id,
            ],
            [
                'rate' => $request->rate,
            ]);
    }
}
