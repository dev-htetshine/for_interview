<?php

namespace App\Services\Domain;

use App\Repositories\User\UserRepository;
use App\Models\Dto\Response\User\UserViewResponseDto;

class UserViewApplication
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
     * @return UserViewResponseDto
     */
    public function handle($userId)
    {
        $userEntity = $this->userRepository->getUserById($userId);

        return new UserViewResponseDto($userEntity);
    }
}
