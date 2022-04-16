<?php

declare(strict_types=1);

namespace App\Http\DTO\Factories;

use App\Http\DTO\UserDto;
use App\Http\Requests\RegistrationRequest;

final class CreateUserDtoFactory
{
    public function createFromRequest(RegistrationRequest $request): UserDto
    {
        return $this->createFromArray($request->validated());
    }

    /**
     * @param array<string, string> $data
     * @return UserDto<mixed>
     */
    private function createFromArray(array $data): UserDto
    {
        $dto = new UserDto();

        $dto->name = $data['name'];
        $dto->email = $data['email'];
        $dto->password = $data['password'];

        return $dto;
    }
}
