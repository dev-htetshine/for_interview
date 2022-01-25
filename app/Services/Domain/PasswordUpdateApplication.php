<?php

namespace App\Services\Domain;

use App\Repositories\User\UserRepository;
use App\Models\Dto\Request\User\PasswordUpdateRequestDto;
use App\Models\Dto\Response\User\PasswordUpdateResponseDto;
use App\Services\Domain\Models\User\PasswordUpdate;

class PasswordUpdateApplication
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
     * @param PasswordUpdateRequestDto $userDto
     * @return PasswordUpdateResponseDto
     */
    public function handle(PasswordUpdateRequestDto $userDto)
    {
        $userEntity = new PasswordUpdate(
            $userDto->password, 
        );

        $this->userRepository->updatePassword($userEntity, $userDto->userId);

        return new PasswordUpdateResponseDto($userEntity);
    }
}