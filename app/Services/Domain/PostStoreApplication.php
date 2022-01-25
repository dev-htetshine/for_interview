<?php

namespace App\Services\Domain;

use App\Repositories\Post\PostRepository;
use App\Models\Dto\Request\Post\PostStoreRequestDto;
use App\Models\Dto\Response\Post\PostStoreResponseDto;
use App\Services\Domain\Models\Post\Post;

class PostStoreApplication
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
     * @param PostStoreRequestDto $postDto
     * @return PostStoreResponseDto
     */
    public function handle(PostStoreRequestDto $postDto)
    {
        $postEntity = new Post(
            $postDto->title, 
            $postDto->comment,
            $postDto->createdUserId,
            $postDto->createdAt
        );

        $this->postRepository->store($postEntity);

        return new PostStoreResponseDto($postEntity);
    }
}
