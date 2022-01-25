<?php

namespace App\Services\Domain;

use App\Repositories\Post\PostRepository;
use App\Models\Dto\Response\Post\PostUpdateResponseDto;
use App\Services\Domain\Models\Post\PostUpdate;

class PostUpdateApplication
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
    public function handle($postDto)
    {
        $postEntity = new PostUpdate(
            $postDto->title, 
            $postDto->comment,
            $postDto->status,
            $postDto->updatedUserId,
            $postDto->updatedAt
        );

        $this->postRepository->update($postEntity, $postDto->postId);

        return new PostUpdateResponseDto($postEntity);
    }
}
