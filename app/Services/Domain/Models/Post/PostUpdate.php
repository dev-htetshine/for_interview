<?php

namespace App\Services\Domain\Models\Post;

class PostUpdate
{
    public string $title;

    public string $comment;

    public int $status;

    public int $updatedUserId;

    public string $updatedAt;

    public function __construct(
        string $title,
        string $comment,
        int $status,
        int $updatedUserId,
        string $updatedAt
    ) {
        $this->title = $title;
        $this->comment = $comment;
        $this->status = $status;
        $this->updatedUserId = $updatedUserId;
        $this->updatedAt = $updatedAt;
    }
}
