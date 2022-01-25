<?php

namespace App\Models\Dto\Request\User;

use Illuminate\Http\UploadedFile;

class UserStoreRequestDto
{
    public string $name;

    public string $email;

    public string $password;

    public UploadedFile $profilePhoto;

    public int $type;

    public string $phone;

    public string $address;

    public string $dateOfBirth;

    public int $createdUserId;

    public string $createdAt;

    public function __construct(
        string $name,
        string $email,
        string $password,
        UploadedFile $profilePhoto,
        int $type,
        string $phone,
        string $address,
        string $dateOfBirth,
        int $createdUserId,
        string $createdAt
    ) {
        $this->name =  $name;
        $this->email = $email;
        $this->password = $password;
        $this->profilePhoto = $profilePhoto;
        $this->type = $type;
        $this->phone = $phone;
        $this->address = $address;
        $this->dateOfBirth = $dateOfBirth;
        $this->createdUserId = $createdUserId;
        $this->createdAt = $createdAt;
    }
}
