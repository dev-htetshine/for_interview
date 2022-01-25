<?php

namespace App\Services\Domain;

use App\Repositories\Post\PostRepository;
use App\Models\Dto\Response\Post\PostListResponseDto;
use App\Services\Domain\Models\Post\Post;

class PostListApplication
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
     * @return PostListResponseDto
     */
    public function handle($currentLogInUser)
    {
        $posts = $this->postRepository->list($currentLogInUser);

        return $posts->map(function ($post) {
            $dto = new PostListResponseDto($post);
            return $dto->toResponse();
        });
    }
}
