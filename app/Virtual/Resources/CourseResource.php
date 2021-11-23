<?php

declare(strict_types = 1);

namespace App\Virtual\Resources;

use App\Virtual\Models\Course;

/**
 * @OA\Schema(
 *     title="CourseResource",
 *     description="Course resource",
 * )
 */
class CourseResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Course[]
     */
    private Course $data;
}
