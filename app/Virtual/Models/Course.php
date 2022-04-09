<?php

declare(strict_types=1);

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Course",
 *     description="Course model",
 *     @OA\Xml(
 *          name="Course"
 *     )
 * )
 *
 */
class Course
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Unique id of course",
     *     format="int64",
     *     example=1,
     * )
     * @var integer
     */

    private int $id;

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
     *      example="This is new course's description"
     * )
     *
     * @var string
     */
    public string $description;

    /**
     * @OA\Property(
     *      title="user ID",
     *      description="User's id of the new course",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public int $user_id;

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

    /**
     * @OA\Property(
     *     title="created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private \DateTime $created_at;

    /**
     * @OA\Property(
     *     title="updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private \DateTime $updated_at;
}
