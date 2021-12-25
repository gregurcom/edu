<?php

declare(strict_types = 1);

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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CourseService
{
    public function getFeed(): LengthAwarePaginator
    {
        $categories = [];

        foreach (Category::get('id') as $category) {
            $categories[] = $category->id;
        }

        if (auth('api')->user()) {
            // check rates
            $rates = Rate::where('user_id', auth('api')->user()->id)->where('rate', '>', 3)->get();
            if ($rates) {
                foreach ($rates as $rate) {
                    array_unshift($categories, $rate->course->category->id);
                }
            }
            // check subscriptions
            $subscriptions = CourseUser::where('user_id', auth('api')->user()->id)->get();
            if ($subscriptions) {
                foreach ($subscriptions as $subscription) {
                    array_unshift($categories, $subscription->course->category->id);
                }
            }
        }

        $courses = collect();
        foreach (array_unique($categories) as $category) {
            $courses = $courses->concat(Course::where('category_id', $category)->get());
        }

        return new LengthAwarePaginator(
            $courses->forPage(Paginator::resolveCurrentPage('page'), 10),
            count($courses),
            10,
            Paginator::resolveCurrentPage('page'),
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
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

    public function storeCourse(StoreCourseRequest $request): Course
    {
        if ($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = $request->image->hashName();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = config('app.article-image');
        }

        return Course::create(array_merge(['user_id' => Auth::id(), 'image' => $imageName], $request->validated()));
    }

    public function searchCourse(SearchRequest $request): AnonymousResourceCollection
    {
        return CourseResource::collection(Course::where('title', 'like', '%' . $request->q . '%')
            ->orWhere('description', 'like', '%' . $request->q . '%')
            ->with(['rates', 'author'])
            ->get());
    }

    public function searchCourseOnCategory(SearchRequest $request): AnonymousResourceCollection
    {
        return CourseResource::collection(
            Course::where('category_id', $request->categoryId)
                ->where(function ($query) use ($request) {
                    return $query->where('title', 'like', '%' . $request->q . '%')
                        ->orWhere('description', 'like', '%' . $request->q . '%');
                })
                ->with(['rates', 'author'])
                ->paginate(10)
        );
    }
}
