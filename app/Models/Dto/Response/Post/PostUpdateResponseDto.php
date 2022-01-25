<?php

namespace App\Models\Dto\Response\Post;

use App\Services\Domain\Models\Post\Post;

class PostUpdateResponseDto
{
    private $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function toResponse()
    {
        return [
            'title' => $this->post->title,
            'comment' => $this->post->comment,
            'status' => $this->post->status
        ];
    }
}
