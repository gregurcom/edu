<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Course;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class RateService
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

    public function getExistingSameRating(Course $course, Request $request): Rate|null
    {
        return $course->rates()
            ->where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->where('rate', $request->rate)
            ->first();
    }
}
