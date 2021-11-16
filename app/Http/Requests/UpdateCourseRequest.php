<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Update Course request",
 *      description="Update Course request body data",
 *      type="object",
 *      required={"title", "description"}
 * )
 */
class UpdateCourseRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|min:6',
        ];
    }
}
