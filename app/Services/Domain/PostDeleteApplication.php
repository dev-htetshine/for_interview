<?php

namespace App\Services\Domain;

use App\Repositories\Post\PostRepository;
use App\Models\Dto\Response\Post\PostDeleteResponseDto;
use App\Services\Domain\Models\Post\PostDelete;

class PostDeleteApplication
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
     * @return PostDeleteResponseDto
     */
    public function handle($postDto)
    {
        $postEntity = new PostDelete(
            $postDto->deletedUserId, 
            $postDto->deletedAt
        );

        $this->postRepository->delete($postEntity, $postDto->postId);

        return new PostDeleteResponseDto($postEntity);
    }
}
