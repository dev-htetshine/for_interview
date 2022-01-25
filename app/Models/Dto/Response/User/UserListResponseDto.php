<?php

namespace App\Models\Dto\Response\User;

use App\Services\Domain\Models\User\User;

class UserListResponseDto
{
    private array $user;

    public function __construct(array $user)
    {
        $this->user = $user;
    }

    public function toResponse()
    {
        return [
            'id' => $this->user['id'],
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'type' => $this->user['type'],
            'phone' => $this->user['phone'],
            'date_of_birth' => $this->user['date_of_birth'],
            'address' => $this->user['address'],
            'created_at' => $this->user['created_at'],
            'updated_at' => $this->user['updated_at'],
            'created_user' => $this->user['created_user']['name']
        ];
    }
}
