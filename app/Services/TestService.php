<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\TestRequest;
use App\Models\Course;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Exception\RuntimeException;

final class TestService
{
    public function store(Course $course, TestRequest $request): Test
    {
        try {
            DB::beginTransaction();

            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['course_id'] = $course->id;
            $data['author_id'] = \Auth::id();

            $test = Test::create($data);

            foreach ($request->questions as $question) {
                Question::create([
                    'title' => $question['title'],
                    'test_id' => $test->id,
                ]);
            }

            DB::commit();

            return $test;
        } catch (\Throwable $throwable) {
            DB::rollBack();
            throw new RuntimeException($throwable->getMessage());
        }
    }
}
