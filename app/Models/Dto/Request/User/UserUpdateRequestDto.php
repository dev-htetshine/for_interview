<?php

namespace App\Models\Dto\Request\User;

class UserUpdateRequestDto
{
    public int $userId;

    public string $name;

    public string $email;

    public $profilePhoto;

    public int $type;

    public string $phone;

    public string $address;

    public string $dateOfBirth;

    public int $updatedUserId;

    public string $updatedAt;

    public function __construct(
        int $userId,
        string $name,
        string $email,
        $profilePhoto,
        int $type,
        string $phone,
        string $address,
        string $dateOfBirth,
        int $updatedUserId,
        string $updatedAt
    ) {
        $this->userId = $userId;
        $this->name =  $name;
        $this->email = $email;
        $this->profilePhoto = $profilePhoto;
        $this->type = $type;
        $this->phone = $phone;
        $this->address = $address;
        $this->dateOfBirth = $dateOfBirth;
        $this->updatedUserId = $updatedUserId;
        $this->updatedAt = $updatedAt;
    }
}
