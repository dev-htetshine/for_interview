<?php

namespace App\Models\Dto\Response\User;

use App\Services\Domain\Models\User\UserDelete;

class UserDeleteResponseDto
{
    private UserDelete $user;

    public function __construct(UserDelete $user)
    {
        $this->user = $user;
    }

    public function toResponse()
    {
        return [
            'deleted_user_id' => $this->user->deletedUserId,
            'deleted_at' => $this->user->deletedAt
        ];
    }
}
