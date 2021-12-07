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
    /**
     * @OA\Get(
     *      path="/search",
     *      operationId="getSearchedCoursesList",
     *      tags={"Courses"},
     *      summary="Get list of courses",
     *      description="Return list of courses",
     *     @OA\Parameter(
     *          name="q",
     *          description="Course title or description",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CourseResource")
     *      ),
     * )
     */
    public function index(SearchRequest $request, CourseService $courseService): JsonResponse
    {
        $courses = $courseService->searchCourse($request);

        return response()->json(['data' => $courses], Response::HTTP_OK);
    }
}
