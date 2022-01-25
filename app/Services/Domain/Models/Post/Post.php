<?php

namespace App\Services\Domain\Models\Post;

class Post
{
    public string $title;

    public string $comment;

    public int $createdUserId;

    public string $createdAt;

    public function __construct(
        string $title,
        string $comment,
        int $createdUserId,
        string $createdAt
    ) {
        $this->title = $title;
        $this->comment = $comment;
        $this->createdUserId = $createdUserId;
        $this->createdAt = $createdAt;
    }
}
