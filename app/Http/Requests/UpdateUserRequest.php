<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->route("userId");
        return [
            'name' => 'required',
            'email' => ['required', 'unique:users,email,' . $userId],
            'profile_photo' => 'mimes:jpeg,png',
            'type' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required|before:today'
        ];
    }
}
