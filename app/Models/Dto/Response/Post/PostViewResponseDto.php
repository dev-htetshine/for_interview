<?php

namespace App\Models\Dto\Response\Post;

use App\Services\Domain\Models\Post\Post;

class PostViewResponseDto
{
    private $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function toResponse()
    {
        return [
            'id' => $this->post->id,
            'title' => $this->post->title,
            'comment' => $this->post->description,
            'status' => $this->post->status,
            'created_user_id' => $this->post->created_user_id
        ];
    }
}
