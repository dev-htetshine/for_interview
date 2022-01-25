<?php

namespace App\Services\Domain;

use App\Repositories\User\UserRepository;
use App\Models\Dto\Request\User\UserStoreRequestDto;
use App\Models\Dto\Response\User\UserStoreResponseDto;
use App\Services\Domain\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserStoreApplication
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
     * @param UserStoreRequestDto $userDto
     * @return UserStoreResponseDto
     */
    public function handle(UserStoreRequestDto $userDto)
    {
        $userEntity = new User(
            $userDto->name,
            $userDto->email,
            $userDto->password,
            $userDto->type,
            $userDto->phone,
            $userDto->address,
            $userDto->dateOfBirth,
            $userDto->createdUserId,
            $userDto->createdAt
        );

        $fileName = $userDto->profilePhoto->getClientOriginalName();

        $this->userRepository->store($userEntity);
        $createdUser = $this->userRepository->getUserByEmail($userEntity->email);

        Storage::disk('profile')->putFileAs($createdUser->id, $userDto->profilePhoto, $fileName);

        $userEntity->profilePhoto = __('domain.userProfileUrl') . $createdUser->id . '/' . $userDto->profilePhoto->getClientOriginalName();

        $this->userRepository->update($userEntity, $createdUser->id);

        return new UserStoreResponseDto($userEntity);
    }
}
