<?php

namespace App\Services\Domain\Models\User;

class UserUpdate
{
    public string $name;

    public string $email;

    public string $profilePhoto;

    public int $type;

    public string $phone;

    public string $address;

    public string $dateOfBirth;

    public int $updatedUserId;

    public string $updatedAt;

    public function __construct(
        string $name,
        string $email,
        string $profilePhoto,
        int $type,
        string $phone,
        string $address,
        string $dateOfBirth,
        int $updatedUserId,
        string $updatedAt
    ) {
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
