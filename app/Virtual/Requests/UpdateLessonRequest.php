<?php

declare(strict_types=1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Update Lesson request",
 *      description="Update Lesson request body data",
 *      type="object",
 *      required={"title", "information"}
 * )
 */
class UpdateLessonRequest
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
}
