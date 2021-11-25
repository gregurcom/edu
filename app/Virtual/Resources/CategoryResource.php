<?php

declare(strict_types = 1);

namespace App\Virtual\Resources;

use App\Virtual\Models\Category;

/**
 * @OA\Schema(
 *     title="CategoryResource",
 *     description="Category resource",
 * )
 */
class CategoryResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Category[]
     */
    private Category $data;
}
