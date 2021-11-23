<?php

declare(strict_types = 1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Create Lesson request",
 *      description="Create Lesson request body data",
 *      type="object",
 *      required={"course_id"}
 * )
 */
class CreateLessonRequest
{
    /**
     * @OA\Property(
     *      title="course ID",
     *      description="Course's id of the new lesson",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public int $course_id;
}
