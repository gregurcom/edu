<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Rate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public function rate(Course $course, Request $request): RedirectResponse
    {
        $rated = $course->rates()->where('user_id', Auth::id())->where('course_id', $course->id)->where('rate', $request->rate)->first();
        if (!$rated) {
            Rate::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'course_id' => $course->id,
                ],
                [
                    'rate' => $request->rate,
                ]);

            return back();
        }

        $rated->delete();

        return back();
    }
}
