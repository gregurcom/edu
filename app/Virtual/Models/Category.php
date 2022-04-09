<?php

declare(strict_types=1);

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Category",
 *     description="Category model",
 *     @OA\Xml(
 *          name="Category"
 *     )
 * )
 *
*/
class Category
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Unique id of category",
     *     format="int64",
     *     example=1,
     * )
     * @var integer
    */

    private int $id;

    /**
     * @OA\Property(
     *     title="name",
     *     description="Category name",
     *     example="web programming",
     * )
     * @var string
    */

    private string $name;

    /**
     * @OA\Property(
     *     title="slug",
     *     description="Category slug",
     *     example="web-programming",
     * )
     * @var string
     */

    private string $slug;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private \DateTime $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private \DateTime $updated_at;
}
