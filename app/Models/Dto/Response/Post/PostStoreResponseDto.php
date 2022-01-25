<?php

namespace App\Models\Dto\Response\Post;

use App\Services\Domain\Models\Post\Post;

class PostStoreResponseDto
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function toResponse()
    {
        return [
            'title' => $this->post->title,
            'comment' => $this->post->comment
        ];
    }
}
