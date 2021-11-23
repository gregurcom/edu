<?php

declare(strict_types = 1);

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Task",
 *     description="Task model",
 *     @OA\Xml(
 *          name="Task"
 *     )
 * )
 *
 */
class Task
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Unique id of task",
     *     format="int64",
     *     example=1,
     * )
     * @var integer
     */

    private int $id;

    /**
     * @OA\Property(
     *     title="title",
     *     description="Task title",
     *     example="read book",
     * )
     * @var string
     */
    private string $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new task",
     *      example="This is new task's description"
     * )
     *
     * @var string
     */
    public string $description;

    /**
     * @OA\Property(
     *      title="user ID",
     *      description="User's id of the new task",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public int $user_id;

    /**
     * @OA\Property(
     *     title="end time",
     *     description="End time of task",
     *     example="2020-01-28 20:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var string
     */
    private string $end_time;

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
