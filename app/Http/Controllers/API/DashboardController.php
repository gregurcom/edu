<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        if (Auth::user()->isAdmin()) {
            $courses = Course::paginate(20);
            $categories = Category::paginate(20);
            $users = User::paginate(20);

            return response()->json(
                ['courses' => $courses, 'categories' => $categories, 'users' => $users],
                Response::HTTP_OK
            );
        }
        $courses = Auth::user()->courses()->get(['id', 'title', 'description']);

        return response()->json($courses, Response::HTTP_OK);
    }
}
