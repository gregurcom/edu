<?php

declare(strict_types=1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Course request",
 *      description="Store Course request body data",
 *      type="object",
 *      required={"title", "description", "category_id"}
 * )
 */
class StoreCourseRequest
{
    /**
     * @OA\Property(
     *     title="title",
     *     description="Course title",
     *     example="programming",
     * )
     * @var string
     */
    private string $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new course",
     *      example="This is new project's description"
     * )
     *
     * @var string
     */
    public string $description;

    /**
     * @OA\Property(
     *      title="category ID",
     *      description="Category's id of the new course",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public int $category_id;
}
