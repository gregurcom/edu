<?php

declare(strict_types=1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Update Course request",
 *      description="Update Course request body data",
 *      type="object",
 *      required={"title", "description"}
 * )
 */
class UpdateCourseRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Name of the new task",
     *      example="Computer networking"
     * )
     *
     * @var string
     */
    public string $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new task",
     *      example="Computer networking is a course..."
     * )
     *
     * @var string
     */
    public string $description;
}
