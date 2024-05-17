<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Rate;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Exception\RuntimeException;

final class CourseService
{
    public function getFeed(): LengthAwarePaginator
    {
        return Course::paginate(10);
    }

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

    public function storeCourse(StoreCourseRequest $request): void
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('image')){
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $imageName = $request->image->hashName();
                $request->image->move(public_path('images'), $imageName);
            } else {
                $imageName = config('app.article-image');
            }
            Course::create(array_merge(['user_id' => Auth::id(), 'image' => $imageName], $request->validated()));

            DB::commit();
        } catch (\Throwable $throwable) {
            DB::rollBack();
            throw new RuntimeException($throwable->getMessage());
        }
    }

    /** @return AnonymousResourceCollection<string, mixed> */
    public function searchCourse(SearchRequest $request): AnonymousResourceCollection
    {
        return CourseResource::collection(Course::where('title', 'like', '%' . $request->searchValue . '%')
            ->orWhere('description', 'like', '%' . $request->searchValue . '%')
            ->with(['rates', 'author'])
            ->get());
    }

    /** @return AnonymousResourceCollection<string, mixed> */
    public function searchCourseOnCategory(SearchRequest $request): AnonymousResourceCollection
    {
        return CourseResource::collection(
            Course::where('category_id', $request->categoryId)
                ->where(function ($query) use ($request) {
                    return $query->where('title', 'like', '%' . $request->searchValue . '%')
                        ->orWhere('description', 'like', '%' . $request->searchValue . '%');
                })
                ->with(['rates', 'author'])
                ->paginate(10)
        );
    }
}
