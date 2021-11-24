<?php

declare(strict_types = 1);

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Subscription",
 *     description="Subscription model",
 *     @OA\Xml(
 *          name="Subscription"
 *     )
 * )
 *
 */
class Subscription
{
    /**
     * @OA\Property(
     *     title="id",
     *     description="Unique id of subscription",
     *     format="int64",
     *     example=1,
     * )
     * @var integer
     */

    private int $id;

    /**
     * @OA\Property(
     *      title="user ID",
     *      description="User's id of the new subscription",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public int $user_id;

    /**
     * @OA\Property(
     *      title="course ID",
     *      description="Course's id of the new subscription",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public int $course_id;
}
