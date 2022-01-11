<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Gate;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'avatar' => $this->avatar,
            'courses' => CourseResource::collection($this->courses),
            'can' => $this->permissions(),
            'created_at' => $this->created_at,
        ];
    }

    protected function permissions(): array
    {
        return [
            'accessAdminPanel' => Gate::allows('accessAdminPanel', $this->resource),
        ];
    }
}

