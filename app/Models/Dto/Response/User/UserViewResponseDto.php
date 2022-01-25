<?php

namespace App\Models\Dto\Response\User;

use App\Services\Domain\Models\User\User;

class UserViewResponseDto
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function toResponse()
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'profile_photo' => $this->user->profile_photo,
            'type' => $this->user->type,
            'phone' => $this->user->phone,
            'address' => $this->user->address,
            'date_of_birth' => $this->user->date_of_birth
        ];
    }
}
