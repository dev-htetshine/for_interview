<?php

namespace App\Repositories\User;

use App\Models\Eloquent\User;
use Hash;
use App\Services\Domain\Exception\NotFoundException;

class UserEloquentRepository implements UserRepository
{
    public function getAuthenticate(string $email, string $password)
    {
        $user =  User::where('email', $email)->first();
        if (Hash::check($password, $user->password)) {
            return $user;
        }
    }

    public function store($userEntity)
    {

        $userEntity = User::insert([
            'name' => $userEntity->name,
            'email' => $userEntity->email,
            'password' => Hash::make($userEntity->password),
            'profile_photo' => $userEntity->profilePhoto,
            'type' => $userEntity->type,
            'phone' => $userEntity->phone,
            'address' => $userEntity->address,
            'date_of_birth' => $userEntity->dateOfBirth,
            'created_user_id' => $userEntity->createdUserId,
            'updated_user_id' => $userEntity->createdUserId,
            'created_at' => $userEntity->createdAt,

        ]);

        return $userEntity;
    }

    public function getUserById($userId)
    {
        $user = User::where('id', $userId)->where('deleted_at', null)->first();

        if ($user === null) {
            throw new NotFoundException(__('domain.user_not_found'));
        }

        return $user;
    }

    public function list()
    {
        $users = User::with('createdUser')
            ->where('deleted_at', null)->get();

        if ($users === null) {
            throw new NotFoundException(__('domain.user_not_found'));
        }

        return $users->map(function ($user) {
            return $user->toArray();
        });
    }

    public function update($userEntity, $userId)
    {
        $user = $this->getUserById($userId);

        $user->name = $userEntity->name;
        $user->email = $userEntity->email;
        $user->profile_photo = $userEntity->profilePhoto;
        $user->type = $userEntity->type;
        $user->phone = $userEntity->phone;
        $user->address = $userEntity->address;
        $user->date_of_birth = $userEntity->dateOfBirth;
        $user->save();

        return $user;
    }

    public function delete($userEntity, $userId)
    {
        $user = $this->getUserById($userId);

        $user->deleted_user_id = $userEntity->deletedUserId;
        $user->deleted_at = $userEntity->deletedAt;
        $user->save();

        return $user;
    }

    public function updatePassword($userEntity, $userId)
    {
        $user = $this->getUserById($userId);
        $user->password = Hash::make($userEntity->password);
        $user->save();

        return $user;
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
