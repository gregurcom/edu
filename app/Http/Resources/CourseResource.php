<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="CourseResource",
 *     description="Course resource",
 * )
 */
class CourseResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'lessons' => LessonResource::collection($this->lessons),
            'category' => $this->category->name,
            'rate' => $this->averageRate(),
            'author' => $this->author->name,
            'created_at' => $this->created_at,
        ];
    }
}
