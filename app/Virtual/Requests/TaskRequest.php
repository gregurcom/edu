<?php

declare(strict_types = 1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Task request",
 *      description="Store Task request body data",
 *      type="object",
 *      required={"title"}
 * )
 */
class TaskRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Name of the new task",
     *      example="Drink coffee"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new task",
     *      example="This is new task's description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="end_time",
     *      description="Limit date of task",
     *      example="2021-11-11 23:31"
     * )
     *
     * @var \DateTime
     */
    public $end_time;
}
