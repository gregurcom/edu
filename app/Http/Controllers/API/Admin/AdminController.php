<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminCourseResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class AdminController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AdminCourseResource::collection(Course::with(['author', 'lessons'])->paginate(10));
    }

    public function search(Request $request): AnonymousResourceCollection
    {
        $courses = Course::where('title', 'like', '%' . $request->q . '%')
            ->with(['author', 'lessons'])
            ->get();
        $user = User::where('name', 'like', '%' . $request->q . '%')->first();

        if ($user) {
            $userCourses = $user->courses()->with(['author', 'lessons'])->get();

            $courses = $courses->merge($userCourses)->paginate(10);
        }

        return AdminCourseResource::collection($courses);
    }
}
