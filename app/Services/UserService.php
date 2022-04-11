<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\DTO\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UserService
{
    public function store(UserDto $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);
    }
}
