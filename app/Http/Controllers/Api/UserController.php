<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\Domain\UserStoreApplication;
use App\Models\Dto\Request\User\UserStoreRequestDto;
use App\Models\Dto\Request\User\UserUpdateRequestDto;
use App\Services\Domain\UserListApplication;
use App\Services\Domain\UserUpdateApplication;
use App\Services\Domain\UserDeleteApplication;
use App\Services\Domain\UserViewApplication;
use App\Models\Dto\Request\User\UserDeleteRequestDto;
use Carbon\Carbon;
use App\Http\Requests\PasswordUpdateRequest;
use App\Services\Domain\PasswordUpdateApplication;
use App\Models\Dto\Request\User\PasswordUpdateRequestDto;

class UserController extends Controller
{
    private UserStoreApplication $userStoreApplication;

    private UserListApplication $userListApplication;

    private UserUpdateApplication $userUpdateApplication;

    private UserDeleteApplication $userDeleteApplication;

    private UserViewApplication $userViewApplication;

    private PasswordUpdateApplication $passwordUpdateApplication;

    public function __construct(
        UserStoreApplication $userStoreApplication,
        UserListApplication $userListApplication,
        UserUpdateApplication $userUpdateApplication,
        UserDeleteApplication $userDeleteApplication,
        UserViewApplication $userViewApplication,
        PasswordUpdateApplication $passwordUpdateApplication
    )
    {
        $this->userStoreApplication = $userStoreApplication;
        $this->userListApplication = $userListApplication;
        $this->userUpdateApplication = $userUpdateApplication;
        $this->userDeleteApplication = $userDeleteApplication;
        $this->userViewApplication = $userViewApplication;
        $this->passwordUpdateApplication = $passwordUpdateApplication;
    }

    public function store(UserRequest $request)
    {
        $request->created_user_id = \Auth::id();
        $request->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $userDto = new UserStoreRequestDto(
            $request->name,
            $request->email,
            $request->password,
            $request->profile_photo,
            $request->type,
            $request->phone,
            $request->address,
            $request->date_of_birth,
            $request->created_user_id,
            $request->created_at,
        );

        return $this->userStoreApplication->handle($userDto)->toResponse();
    }

    public function list()
    {
        return $this->userListApplication->handle();
    }

    public function update(UpdateUserRequest $request, $userId)
    {
        $request->updated_user_id = \Auth::id();
        $request->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $request->user_id = $userId;

        $userDto = new UserUpdateRequestDto(
            $request->user_id,
            $request->name,
            $request->email,
            $request->profile_photo,
            $request->type,
            $request->phone,
            $request->address,
            $request->date_of_birth,
            $request->updated_user_id,
            $request->updated_at,
        );

        return $this->userUpdateApplication->handle($userDto)->toResponse();
    }

    public function view($userId)
    {
        return $this->userViewApplication->handle($userId)->toResponse();
    }

    public function destroy($userId)
    {
        $deletedUserId =  \Auth::id();
        $deletedAt =  Carbon::now()->format('Y-m-d H:i:s');

        $userDto =  new UserDeleteRequestDto(
            $userId,
            $deletedUserId,
            $deletedAt
        );

        return $this->userDeleteApplication->handle($userDto)->toResponse();
    }

    public function passwordUpdate(PasswordUpdateRequest $request, $userId)
    {
        $request->user_id = $userId;

        $userDto = new PasswordUpdateRequestDto(
            $request->user_id,
            $request->password
        );

        return $this->passwordUpdateApplication->handle($userDto)->toResponse();
    }
}
