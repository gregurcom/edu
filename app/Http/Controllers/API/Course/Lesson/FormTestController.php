<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Course\Lesson;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Http\Resources\TestResource;
use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FormTestController extends Controller
{
    public function show(Course $course): JsonResponse
    {
        return response()->json([
            'tests' => [
                $course->tests()->with('questions.responses')->get()
            ]
        ], Response::HTTP_OK);
    }

    public function store(Course $course, TestRequest $request): JsonResponse
    {
        if ($request->questions) {
            DB::beginTransaction();

            try {
                $data = $request->validated();
                $data['course_id'] = $course->id;
                $data['author_id'] = \Auth::id();

                $test = Test::create($data);

                foreach ($request->questions as $question) {
                    Question::create([
                        'title' => $question['title'],
                        'test_id' => $test->id,
                    ]);
                }
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            DB::commit();

            return response()->json(['test' => TestResource::make($test)], Response::HTTP_CREATED);
        }

        return response()->json(['message' => 'No questions'], Response::HTTP_BAD_REQUEST);
    }

    public function destroy(Test $test): JsonResponse
    {
        $test->delete();

        return response()->json(['message' => 'Test was destroyed'], Response::HTTP_OK);
    }
}
