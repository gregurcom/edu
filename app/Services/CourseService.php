<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CourseService
{
    public function searchCourse(Request $request): array|Collection
    {
        return Course::where('title', 'like', '%' . $request->q . '%')
            ->orWhere('description', 'like', '%' . $request->q . '%')
            ->with(['rates', 'author'])
            ->get();
    }
}
