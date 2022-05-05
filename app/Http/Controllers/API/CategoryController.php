<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/categories",
     *      operationId="getCategoriesList",
     *      tags={"Categories"},
     *      summary="Get list of categories",
     *      description="Return list of categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
     *       ),
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(CategoryResource::collection(Category::all()), Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *      path="/categories/{id}",
     *      operationId="getCategory",
     *      tags={"Categories"},
     *      summary="Get category",
     *      description="Return category",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
     *       ),
     *     @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * )
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json(new CategoryResource($category), Response::HTTP_OK);
    }
}
