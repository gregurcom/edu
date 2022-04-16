<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Gate;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /** @return array<string, mixed> */
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

    /** @return array<string, bool> */
    protected function permissions(): array
    {
        return [
            'accessAdminPanel' => Gate::allows('accessAdminPanel', $this->resource),
        ];
    }
}

