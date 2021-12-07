<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * @OA\Get(
     *      path="/courses",
     *      operationId="getCoursesList",
     *      tags={"Courses"},
     *      summary="Get list of courses",
     *      description="Return list of courses",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CourseResource")
     *       ),
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return CourseResource::collection(Course::paginate(10));
    }

    /**
     * @OA\Get(
     *      path="/courses/{id}",
     *      operationId="getCourse",
     *      tags={"Courses"},
     *      summary="Get course",
     *      description="Return course",
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CourseResource")
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */
    public function show(Course $course): CourseResource
    {
        return new CourseResource($course);
    }

    /**
     * @OA\Post(
     *      path="/courses",
     *      operationId="storeCourse",
     *      tags={"Courses"},
     *      summary="Store new course",
     *      description="Return course data",
     *      security={{ "Bearer":{} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCourseRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Course")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    public function store(StoreCourseRequest $request): JsonResponse
    {
        $course = Course::create(array_merge(['user_id' => Auth::id()], $request->validated()));

        return response()->json($course, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *      path="/courses/{id}",
     *      operationId="updateCourse",
     *      tags={"Courses"},
     *      summary="Update existing course",
     *      description="Returns updated course data",
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCourseRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Course")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(Course $course, StoreCourseRequest $request): JsonResponse
    {
        $course->update($request->validated());

        return response()->json($course, Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/courses/{id}",
     *      operationId="deleteCourse",
     *      tags={"Courses"},
     *      summary="Delete existing course",
     *      description="Deletes a record and returns no content",
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Course $course): JsonResponse
    {
        $course->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function search(SearchRequest $request, CourseService $courseService): JsonResponse
    {
        $courses = $courseService->searchCourse($request);

        return response()->json($courses, Response::HTTP_OK);
    }
}
