<?php

namespace App\Services\Domain;

use App\Repositories\User\UserRepository;
use App\Models\Dto\Response\User\UserListResponseDto;
use App\Services\Domain\Models\User\User;

class UserListApplication
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * 申込/被保険者/健康診断書/決済情報を登録する
     *
     * @return UserListResponseDto
     */
    public function handle()
    {
        $users = $this->userRepository->list();

        return $users->map(function ($user) {
            $dto = new UserListResponseDto($user);
            return $dto->toResponse();
        });
    }
}
