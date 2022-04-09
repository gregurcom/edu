<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Course\Lesson;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Http\Resources\TestResource;
use App\Models\Course;
use App\Models\Test;
use App\Services\TestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

final class FormTestController extends Controller
{
    public function index(Course $course): JsonResponse
    {
        return response()->json([
            'tests' => [
                $course->tests()->with('questions.responses')->get()
            ]
        ], Response::HTTP_OK);
    }

    public function show(Test $test): JsonResponse
    {
        return response()->json(['test' => TestResource::make($test)], Response::HTTP_OK);
    }

    public function store(Course $course, TestRequest $request, TestService $testService): JsonResponse
    {
        DB::beginTransaction();
        try {
            $test = $testService->store($course, $request);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        DB::commit();

        return response()->json(['test' => TestResource::make($test)], Response::HTTP_CREATED);
    }

    public function destroy(Test $test): JsonResponse
    {
        $test->delete();

        return response()->json(['message' => 'Test was destroyed'], Response::HTTP_OK);
    }
}
