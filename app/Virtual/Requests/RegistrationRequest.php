<?php

declare(strict_types = 1);

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Register User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"name", "email", "password", "password_confirmation"}
 * )
 */
class RegistrationRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="Name of the new user",
     *      example="Taylor"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="User email",
     *      example="taylor@gmail.com"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="User password",
     *      example=12345678
     * )
     *
     * @var string
     */
    public string $password;

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="User password confirmation",
     *      example=12345678
     * )
     *
     * @var string
     */
    public string $password_confirmation;
}
