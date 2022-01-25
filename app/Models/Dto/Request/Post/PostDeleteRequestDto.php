<?php

namespace App\Models\Dto\Request\Post;

class PostDeleteRequestDto
{
    public int $postId;

    public int $deletedUserId;

    public string $deletedAt;

    public function __construct(
        int $postId,
        int $deletedUserId,
        string $deletedAt
    ) {
        $this->postId = $postId;
        $this->deletedUserId =  $deletedUserId;
        $this->deletedAt = $deletedAt;
    }
}
