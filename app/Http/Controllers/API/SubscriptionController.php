<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionController extends Controller
{
    public function index(): JsonResponse
    {
        $courses = Auth::user()->subscriptions()->with(['author', 'rates'])->get();

        return response()->json($courses, Response::HTTP_OK);
    }

    public function store(Course $course): JsonResponse
    {
        CourseUser::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return response()->json('You have successfully subscribed', Response::HTTP_CREATED);
    }

    public function destroy(Course $course): JsonResponse
    {
        CourseUser::where('user_id', Auth::id())->where('course_id', $course->id)->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
