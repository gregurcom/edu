<?php

declare(strict_types=1);

namespace App\Http\DTO;

/**
 * @template T
 */
final class UserDto
{
    public string $name;
    public string $email;
    public string $password;
}
