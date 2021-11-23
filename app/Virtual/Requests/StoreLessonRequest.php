<?php

declare(strict_types = 1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Lesson request",
 *      description="Store Lesson request body data",
 *      type="object",
 *      required={"title", "description", "course_id"}
 * )
 */
class StoreLessonRequest
{
    /**
     * @OA\Property(
     *     title="title",
     *     description="Lesson title",
     *     example="programming basics",
     * )
     * @var string
     */
    private string $title;

    /**
     * @OA\Property(
     *     title="information",
     *     description="Lesson information",
     *     example="programming...",
     * )
     * @var string
     */
    private string $information;

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

    /**
     * @OA\Property(
     *      title="status",
     *      description="Status of lesson. Can be 0 (not important) or 1 (important)",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    private int $status;
}
