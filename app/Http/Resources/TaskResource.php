<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="TaskResource",
 *     description="Task resource",
 *     @OA\Xml(
 *         name="TaskResource"
 *     )
 * )
 */
class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        /**
         * @OA\Property(
         *     title="Title",
         *     description="Task title",
         * )
         *
         * @var \App\\Models\Task
         */

        return [
            'title' => $this->title,
            'description' => $this->description,
            'end_time' => $this->end_time,
            'user' => $this->user->name,
        ];
    }
}
