<?php

namespace App\Models\Dto\Request\User;

class PasswordUpdateRequestDto
{
    public int $userId;

    public string $password;

    public function __construct(
        int $userId,
        string $password
    ) {
        $this->userId = $userId;
        $this->password =  $password;
    }
}
