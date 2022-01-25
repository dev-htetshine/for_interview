<?php

namespace App\Services\Domain;

use App\Repositories\Post\PostRepository;
use App\Models\Dto\Response\Post\PostViewResponseDto;

class PostViewApplication
{
    private $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * 申込/被保険者/健康診断書/決済情報を登録する
     * 
     * @return PostUpdateResponseDto
     */
    public function handle($postId)
    {
        $postEntity = $this->postRepository->getPostById($postId);

        return new PostViewResponseDto($postEntity);
    }
}
