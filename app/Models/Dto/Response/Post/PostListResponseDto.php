<?php

namespace App\Models\Dto\Response\Post;

use App\Services\Domain\Models\Post\Post;

class PostListResponseDto
{
    private array $post;

    public function __construct(array $post)
    {
        $this->post = $post;
    }

    public function toResponse()
    {
        return [
            'id' => $this->post['id'],
            'title' => $this->post['title'],
            'comment' => $this->post['description'],
            'createdUser' => $this->post['user']['name'],
            'createdAt' => $this->post['created_at']
        ];
    }
}
