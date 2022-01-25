<?php

namespace App\Repositories\User;

interface UserRepository
{
    public function getAuthenticate(string $email, string $password);

    public function store($userEntity);

    public function getUserById($userId);

    public function list();

    public function update($userEntity, $userId);

    public function delete($userEntity, $userId);

    public function updatePassword($userEntity, $userId);

    public function getUserByEmail(string $email);
}