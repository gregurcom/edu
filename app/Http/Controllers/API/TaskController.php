<?php

declare(strict_types = 1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * @OA\Get(
     *      path="/tasks",
     *      operationId="getTasksList",
     *      tags={"Tasks"},
     *      summary="Get list of tasks",
     *      description="Returns list of tasks",
     *      security={{ "Bearer":{} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     )
     */
    public function index(TaskService $taskService): JsonResponse
    {
        $taskResource = TaskResource::collection($taskService->get());

        return response()->json($taskResource, Response::HTTP_OK);
    }

    /**
     * @OA\Post(
     *      path="/tasks",
     *      operationId="storeTask",
     *      tags={"Tasks"},
     *      summary="Store new task",
     *      description="Returns task data",
     *      security={{ "Bearer":{} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    public function store(TaskRequest $request): JsonResponse
    {
        $task = Task::create(array_merge(['user_id' => Auth::id()], $request->all()));

        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *      path="/tasks/{id}",
     *      operationId="updateTask",
     *      tags={"Tasks"},
     *      summary="Update existing task",
     *      description="Returns updated task data",
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/TaskRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json($task, Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/tasks/{id}",
     *      operationId="deleteTask",
     *      tags={"Tasks"},
     *      summary="Delete existing task",
     *      description="Deletes a record and returns no content",
     *      security={{ "Bearer":{} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
