<?php

declare(strict_types=1);

namespace App\Virtual\Resources;

use App\Virtual\Models\Lesson;

/**
 * @OA\Schema(
 *     title="LessonResource",
 *     description="Lesson resource",
 * )
 */
class LessonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var Lesson[]
     */
    private Lesson $data;
}
