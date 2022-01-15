<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminController extends Controller
{
    public function search(Request $request): AnonymousResourceCollection
    {
        $courses = Course::where('title', 'like', '%' . $request->q . '%')->with('author')->get();
        $user = User::where('name', 'like', '%' . $request->q . '%')->first();
        if ($user) {
            $userCourses = $user->courses()->with('author')->get();

            $courses = $courses->merge($userCourses)->paginate(10);
        }

        return CourseResource::collection($courses);
    }
}
