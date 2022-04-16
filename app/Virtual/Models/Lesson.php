<?php

declare(strict_types=1);

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Lesson",
 *     description="Lesson model",
 *     @OA\Xml(
 *          name="Lesson"
 *     )
 * )
 *
 */
class Lesson
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Unique id of lesson",
     *     format="int64",
     *     example=1,
     * )
     * @var integer
     */

    private int $id;

    /**
     * @OA\Property(
     *     title="title",
     *     description="Lesson title",
     *     example="HTML5 basic",
     * )
     * @var string
     */
    private string $title;

    /**
     * @OA\Property(
     *      title="information",
     *      description="Information of the new lesson",
     *      example="Lesson information..."
     * )
     *
     * @var string
     */
    public string $information;

    /**
     * @OA\Property(
     *      title="course ID",
     *      description="course id of new lesson",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public int $course_id;

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
