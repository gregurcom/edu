<?php

declare(strict_types=1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\RateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class RateController extends Controller
{
    public function __invoke(Course $course, Request $request, RateService $rateService): RedirectResponse
    {
        $existingSameRating = $rateService->getExistingSameRating($course, $request);

        if ($existingSameRating) {
            $existingSameRating->delete();

            return back();
        }

        $rateService->updateRating($course, $request);

        return back();
    }
}
