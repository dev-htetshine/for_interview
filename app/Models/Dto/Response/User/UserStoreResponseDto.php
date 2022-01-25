<?php

namespace App\Models\Dto\Response\User;

use App\Services\Domain\Models\User\User;

class UserStoreResponseDto
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function toResponse()
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => $this->user->password,
            'profile_photo' => $this->user->profilePhoto,
            'type' => $this->user->type,
            'phone' => $this->user->phone,
            'address' => $this->user->address,
            'date_of_birth' => $this->user->dateOfBirth,
            'created_user_id' => $this->user->createdUserId,
            'created_at' => $this->user->createdAt
        ];
    }
}
