<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|required_with:password|same:password|min:8',
            'profile_photo' => 'required|mimes:jpeg,png',
            'type' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required|before:today'
        ];
    }
}
