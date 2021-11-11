<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CourseResource::collection(Course::all());
    }

    public function show(Course $course): CourseResource
    {
        return new CourseResource($course);
    }

    public function store(StoreCourseRequest $request): Response
    {
        $course = Course::create(array_merge(['user_id' => Auth::id()], $request->validated()));

        return response(['course' => $course], 201);
    }

    public function update(Course $course, StoreCourseRequest $request): Response
    {
        $course->update($request->validated());

        return response(['course' => $course], 204);
    }

    public function destroy(Course $course): Response
    {
        $course->delete();

        return response(['message' => 'Destroy course'], 200);
    }
}
