<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function index(): JsonResponse
    {
        $courses = CourseResource::collection(Course::paginate(10));

        return response()->json($courses, Response::HTTP_OK);
    }
}
