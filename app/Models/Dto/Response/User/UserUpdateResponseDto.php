<?php

namespace App\Models\Dto\Response\User;

use App\Services\Domain\Models\User\UserUpdate;

class UserUpdateResponseDto
{
    private UserUpdate $user;

    public function __construct(UserUpdate $user)
    {
        $this->user = $user;
    }

    public function toResponse()
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'profile_photo' => $this->user->profilePhoto,
            'type' => $this->user->type,
            'phone' => $this->user->phone,
            'address' => $this->user->address,
            'date_of_birth' => $this->user->dateOfBirth,
            'updated_user_id' => $this->user->updatedUserId,
            'updated_at' => $this->user->updatedAt
        ];
    }
}
