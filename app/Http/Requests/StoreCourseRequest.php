<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Course request",
 *      description="Store Course request body data",
 *      type="object",
 *      required={"title", "description", "category_id"}
 * )
 */
class StoreCourseRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      description="Name of the new task",
     *      example="Computer networking"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new task",
     *      example="Computer networking is a course..."
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="category_id",
     *      description="Category id",
     *      example=1
     * )
     *
     * @var integer
     */
    public $category_id;

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|min:6',
            'category_id' => 'required|integer',
        ];
    }
}
