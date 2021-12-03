<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    public function index(SearchRequest $request, CourseService $courseService): JsonResponse
    {
        $courses = $courseService->searchCourse($request);

        return response()->json($courses, Response::HTTP_OK);
    }
}
