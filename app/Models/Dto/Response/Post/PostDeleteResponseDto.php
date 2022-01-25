<?php

namespace App\Models\Dto\Response\Post;

use App\Services\Domain\Models\Post\PostDelete;

class PostDeleteResponseDto
{
    private PostDelete $post;

    public function __construct(PostDelete $post)
    {
        $this->post = $post;
    }

    public function toResponse()
    {
        return [
            'deleted_user_id' => $this->post->deletedUserId,
            'deleted_at' => $this->post->deletedAt
        ];
    }
}
