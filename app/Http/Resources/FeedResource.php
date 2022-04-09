<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedResource extends JsonResource
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
            'description' => $this->description,
            'image' => $this->image,
            'rate' => $this->averageRate(),
            'author' => $this->author,
            'created_at' => $this->created_at->isoformat('Do MMM YY'),
        ];
    }
}
