<?php

namespace App\Services\Domain;

use App\Repositories\User\UserRepository;
use App\Models\Dto\Request\User\UserDeleteRequestDto;
use App\Models\Dto\Response\User\UserDeleteResponseDto;
use App\Services\Domain\Models\User\UserDelete;

class UserDeleteApplication
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
     * @param UserDeleteRequestDto $userDto
     * @return UserDeleteResponseDto
     */
    public function handle(UserDeleteRequestDto $userDto)
    {
        $userEntity = new UserDelete(
            $userDto->deletedUserId, 
            $userDto->deletedAt
        );

        $this->userRepository->delete($userEntity, $userDto->userId);

        return new UserDeleteResponseDto($userEntity);
    }
}