<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Login User request",
 *      description="Login user request body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class AccessRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="User email",
     *      example="taylor@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="User password",
     *      example=12345678
     * )
     *
     * @var string
     */
    public $password;

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ];
    }
}
