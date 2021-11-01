<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CourseService
{
    public function getCourses(Category $category): LengthAwarePaginator
    {
        $currentPage = request()->get('page', 1);

        if (Cache::has($category->id . '-category-' . $currentPage)) {
            $courses = Cache::get($category->id . '-category-' . $currentPage);
        } else {
            $courses = Cache::remember($category->id . '-category-' . $currentPage, now()->addMinutes(30), function () use ($category) {
                return $category->courses()->with(['author', 'rates'])->paginate(10);
            });
        }

        return $courses;
    }

    public function searchCourse(Request $request): array|Collection
    {
        return Course::where('title', 'like', '%' . $request->q . '%')
            ->orWhere('description', 'like', '%' . $request->q . '%')
            ->with(['rates', 'author'])
            ->get();
    }
}
