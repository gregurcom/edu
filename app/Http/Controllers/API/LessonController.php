<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

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

class LessonController extends Controller
{
    public function show(Lesson $lesson): JsonResponse
    {
        $readDuration = $lesson->getReadDuration();
        $lesson = new LessonResource($lesson);

        return response()->json([$lesson, $readDuration], Response::HTTP_OK);
    }

    public function create(CreateLessonRequest $request): JsonResponse
    {
        return response()->json($request->course_id, Response::HTTP_OK);
    }

    public function store(StoreLessonRequest $lessonRequest, StoreFileRequest $fileRequest, LessonService $lessonService): JsonResponse
    {
        DB::beginTransaction();

        try {
            $lesson = Lesson::create($lessonRequest->validated());

            if ($fileRequest->hasFile('files')) {
                $lessonService->storeAttachedFiles($lesson, $fileRequest);
            }
            if ($lessonRequest->status == 1) {
                // send emails to subscribers with a link to lesson
                $lessonService->sendLessonCreateNotification($lesson);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($lesson, Response::HTTP_CREATED);
    }

    public function edit(Lesson $lesson): JsonResponse
    {
        $this->authorize('view', $lesson);

        return response()->json($lesson, Response::HTTP_OK);
    }

    public function update(Lesson $lesson, UpdateLessonRequest $request): JsonResponse
    {
        $this->authorize('update', $lesson);
        $lesson->update($request->validated());

        return response()->json($lesson, Response::HTTP_ACCEPTED);
    }

    public function destroy(Lesson $lesson): JsonResponse
    {
        $this->authorize('destroy', $lesson);
        $lesson->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
