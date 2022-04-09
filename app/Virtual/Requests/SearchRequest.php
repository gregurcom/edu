<?php

declare(strict_types=1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Search Course request",
 *      type="object",
 *      required={"q"}
 * )
 */
class SearchRequest
{
    /**
     * @OA\Property(
     *     title="q",
     *     description="Course title or description",
     *     example="programming",
     * )
     * @var string
     */
    private string $q;
}
