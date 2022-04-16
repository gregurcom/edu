<?php

declare(strict_types=1);

namespace App\Http\DTO;

/**
 * @template T
*/
final class LessonDto
{
    public string $title;
    public string $information;
    public int $course_id;
    public ?string $status;
}
