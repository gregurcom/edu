<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Course\Lesson;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLessonRequest;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Services\LessonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

final class LessonController extends Controller
{
    /**
     * @OA\Get(
     *      path="/lessons/{id}",
     *      operationId="getLesson",
     *      tags={"Lessons"},
     *      summary="Get lesson",
     *      description="Return lesson",
     *      @OA\Parameter(
     *          name="id",
     *          description="Lesson id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LessonResource")
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */
    public function show(Lesson $lesson): JsonResponse
    {
        $readDuration = $lesson->getReadDuration();
        $lesson = new LessonResource($lesson);

        return response()->json([$lesson, $readDuration], Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *      path="/lessons/create",
     *      operationId="lessonCreation",
     *      tags={"Lessons"},
     *      summary="Get course id for creating lesson",
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *          name="course_id",
     *          description="Course id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */
    public function create(CreateLessonRequest $request): JsonResponse
    {
        return response()->json($request->course_id, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *      path="/lessons",
     *      operationId="storeLesson",
     *      tags={"Lessons"},
     *      summary="Store new lesson",
     *      description="Return lesson data",
     *      security={{ "Bearer":{} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLessonRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Lesson")
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
    public function store(StoreLessonRequest $lessonRequest, StoreFileRequest $fileRequest, LessonService $lessonService): JsonResponse
    {
        try {
            DB::beginTransaction();

            $lesson = Lesson::create($lessonRequest->validated());

            if ($fileRequest->hasFile('files')) {
                $lessonService->storeAttachedFiles($lesson, $fileRequest);
            }
            if ($lessonRequest->status == 1) {
                // send emails to subscribers with a link to lesson
                $lessonService->sendLessonCreateNotification($lesson);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($lesson, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *      path="/lessons/{id}",
     *      operationId="updateLesson",
     *      tags={"Lessons"},
     *      summary="Update existing lesson",
     *      description="Returns updated lesson data",
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Lesson id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateLessonRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Lesson")
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
    public function update(Lesson $lesson, UpdateLessonRequest $request): JsonResponse
    {
        $lesson->update($request->validated());

        return response()->json($lesson, Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/lessons/{id}",
     *      operationId="deleteLesson",
     *      tags={"Lessons"},
     *      summary="Delete existing lesson",
     *      description="Deletes a record and returns no content",
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Lesson id",
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
    public function destroy(Lesson $lesson): JsonResponse
    {
        $lesson->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
