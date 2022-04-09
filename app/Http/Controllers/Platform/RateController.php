<?php

declare(strict_types=1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Rate;
use App\Services\RateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class RateController extends Controller
{
    public function __invoke(Course $course, Request $request, RateService $rateService): RedirectResponse
    {
        $existingSameRating = $this->getExistingSameRating($course, $request);

        if ($existingSameRating) {
            $existingSameRating->delete();

            return back();
        }
        $rateService->updateRating($course, $request);

        return back();
    }

    private function getExistingSameRating(Course $course, Request $request): Rate|null
    {
        return $course->rates()
            ->where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->where('rate', $request->rate)
            ->first();
    }
}
