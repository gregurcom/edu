<?php

declare(strict_types=1);

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Unique id of user",
     *     format="int64",
     *     example=1,
     * )
     * @var integer
     */

    private int $id;

    /**
     * @OA\Property(
     *     title="name",
     *     description="User name",
     *     example="Joe Doe",
     * )
     * @var string
     */

    private string $name;

    /**
     * @OA\Property(
     *     title="email",
     *     description="User email",
     *     example="joe@gmail.com",
     * )
     * @var string
     */

    private string $email;

    /**
     * @OA\Property(
     *     title="password",
     *     description="User password",
     *     example="joedoe123",
     * )
     * @var string
     */

    private string $password;

    /**
     * @OA\Property(
     *     title="created at",
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
     *     title="updated at",
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
