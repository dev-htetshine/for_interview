<?php

namespace App\Models\Dto\Request\Post;

class PostUpdateRequestDto
{
    public int $postId;

    public string $title;

    public string $comment;

    public int $status;

    public int $updatedUserId;

    public string $updatedAt;

    public function __construct(
        int $postId,
        string $title,
        string $comment,
        int $status,
        int $updatedUserId,
        string $updatedAt
    ) {
        $this->postId = $postId;
        $this->title =  $title;
        $this->comment = $comment;
        $this->status = $status;
        $this->updatedUserId = $updatedUserId;
        $this->updatedAt = $updatedAt;
    }
}
