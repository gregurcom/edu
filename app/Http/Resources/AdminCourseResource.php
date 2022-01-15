<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminCourseResource extends JsonResource
{
    public function __construct(Course $model)
    {
        parent::__construct($model);
    }

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'lessons' => $this->lessons,
            'author' => $this->author,
        ];
    }
}
