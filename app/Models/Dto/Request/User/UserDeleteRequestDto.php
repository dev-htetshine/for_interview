<?php

namespace App\Models\Dto\Request\User;

class UserDeleteRequestDto
{
    public int $userId;

    public int $deletedUserId;

    public string $deletedAt;

    public function __construct(
        int $userId,
        int $deletedUserId,
        string $deletedAt
    ) {
        $this->userId = $userId;
        $this->deletedUserId =  $deletedUserId;
        $this->deletedAt = $deletedAt;
    }
}
