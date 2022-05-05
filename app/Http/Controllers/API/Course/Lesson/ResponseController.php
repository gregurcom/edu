<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Course\Lesson;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResponseRequest;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

final class ResponseController extends Controller
{
    public function index(Question $question): JsonResponse
    {
        return response()->json(['responses' => $question->responses], HttpResponse::HTTP_OK);
    }

    public function store(Question $question, ResponseRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['question_id'] = $question->id;
        $data['user_id'] = \Auth::id();

        $response = Response::create($data);

        return response()->json(['response' => $response], HttpResponse::HTTP_CREATED);
    }

    public function update(Response $response, ResponseRequest $request): JsonResponse
    {
        $response = $response->update($request->validated());

        return response()->json(['response' => $response], HttpResponse::HTTP_OK);
    }

    public function destroy(Response $response): HttpResponse
    {
        $response->delete();

        return response()->noContent();
    }
}
