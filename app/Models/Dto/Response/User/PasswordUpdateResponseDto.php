<?php

namespace App\Models\Dto\Response\User;

use App\Services\Domain\Models\User\PasswordUpdate;

class PasswordUpdateResponseDto
{
    private PasswordUpdate $user;

    public function __construct(PasswordUpdate $user)
    {
        $this->user = $user;
    }

    public function toResponse()
    {
        return [
            'password' => $this->user->password
        ];
    }
}
