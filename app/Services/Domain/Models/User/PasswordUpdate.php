<?php

namespace App\Services\Domain\Models\User;

class PasswordUpdate
{
    public string $password;

    public function __construct(
        string $password
    ) {
        $this->password =  $password;
    }
}
