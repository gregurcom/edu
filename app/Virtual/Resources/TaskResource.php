<?php

declare(strict_types=1);

namespace App\Virtual\Resources;

use App\Virtual\Models\Task;

/**
 * @OA\Schema(
 *     title="TaskResource",
 *     description="Task resource",
 * )
 */
class TaskResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Task[]
     */
    private Task $data;
}
