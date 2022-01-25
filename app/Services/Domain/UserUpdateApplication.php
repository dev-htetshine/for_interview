<?php

namespace App\Services\Domain;

use App\Repositories\User\UserRepository;
use App\Models\Dto\Request\User\UserUpdateRequestDto;
use App\Models\Dto\Response\User\UserUpdateResponseDto;
use App\Services\Domain\Models\User\UserUpdate;
use Illuminate\Support\Facades\Storage;

class UserUpdateApplication
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
     * @param UserUpdateRequestDto $userDto
     * @return UserUpdateResponseDto
     */
    public function handle(UserUpdateRequestDto $userDto)
    {
        $fileName = $this->updateProfile($userDto);
        $path = __('domain.userProfileUrl') . $userDto->userId . '/' . $fileName;

        $userEntity = new UserUpdate(
            $userDto->name,
            $userDto->email,
            $path,
            $userDto->type,
            $userDto->phone,
            $userDto->address,
            $userDto->dateOfBirth,
            $userDto->updatedUserId,
            $userDto->updatedAt
        );

        $this->userRepository->update($userEntity, $userDto->userId);

        return new UserUpdateResponseDto($userEntity);
    }

    public function updateProfile(UserUpdateRequestDto $user)
    {
        $userEntity = $this->userRepository->getUserById($user->userId);
        $path = explode("/", $userEntity->profile_photo);
        $oldFileName = $path[count($path) - 1];
        if ($user->profilePhoto) {
            $newFileName = $user->profilePhoto->getClientOriginalName();
            // delete the old profile.
            Storage::disk('profile')->delete($user->userId . '/' . $oldFileName);
            // insert new profile.
            Storage::disk('profile')->putFileAs($user->userId, $user->profilePhoto, $newFileName);
            return $newFileName;
        } else {
            return $oldFileName;
        }
    }
}
