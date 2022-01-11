<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $courses = Auth::user()->courses()->get(['id', 'title', 'description']);
        $user = new UserResource(Auth::user());

        return response()->json(['courses' => $courses, 'user' => $user], Response::HTTP_OK);
    }
}
