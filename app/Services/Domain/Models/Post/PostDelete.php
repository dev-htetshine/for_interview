<?php

namespace App\Services\Domain\Models\Post;

class PostDelete
{
    public int $deletedUserId;

    public string $deletedAt;

    public function __construct(
        int $deletedUserId,
        string $deletedAt
    ) {
        $this->deletedUserId =  $deletedUserId;
        $this->deletedAt = $deletedAt;
    }
}
