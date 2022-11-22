<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => ['required', 'max:100'],
            'lastname' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore($this->user->id),],
            'address' => ['max:255'],
            'city' => ['max:255'],
            'country' => ['max:255'],
            'postal' => ['max:255'],
            'about' => ['max:255'],
            'bank' => ['max:10'],
            'credit_number' => ['max:20'],
            'avatar' => [
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg'
            ],
            'role_id' => ['required']
        ];
    }
}
