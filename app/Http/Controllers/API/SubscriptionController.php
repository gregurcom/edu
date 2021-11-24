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
    /**
     * @OA\Get(
     *      path="/subscriptions",
     *      operationId="getSubscriptions",
     *      tags={"Subscriptions"},
     *      summary="Get list of subscriptions",
     *      description="Return list of subscriptions",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     * )
     */
    public function index(): JsonResponse
    {
        $courses = Auth::user()->subscriptions()->with(['author', 'rates'])->get();

        return response()->json($courses, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *      path="/subscriptions/{courseId}",
     *      operationId="storeSubscription",
     *      tags={"Subscriptions"},
     *      summary="Store new subscription",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Subscription")
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
    public function store(Course $course): JsonResponse
    {
        CourseUser::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return response()->json('You have successfully subscribed', Response::HTTP_CREATED);
    }

    /**
     * @OA\Delete(
     *      path="/subscriptions/{courseId}",
     *      operationId="deleteSubscription",
     *      tags={"Subscriptions"},
     *      summary="Delete existing subscription",
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
        CourseUser::where('user_id', Auth::id())->where('course_id', $course->id)->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
