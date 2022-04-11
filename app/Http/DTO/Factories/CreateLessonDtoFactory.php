<?php

declare(strict_types=1);

namespace App\Http\DTO\Factories;

use App\Http\DTO\LessonDto;
use App\Http\Requests\StoreLessonRequest;

final class CreateLessonDtoFactory
{
    public function createFromRequest(StoreLessonRequest $request): LessonDto
    {
        return self::createFromArray($request->validated());
    }

    private function createFromArray(array $data): LessonDto
    {
        $dto = new LessonDto();

        $dto->title = $data['title'];
        $dto->information = $data['information'];
        $dto->course_id = (int) $data['course_id'];
        $dto->status = $data['status'];

        return $dto;
    }
}
