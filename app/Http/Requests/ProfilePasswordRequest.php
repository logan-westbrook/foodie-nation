<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => [ 'required', 'min:5', 'current_password' ],
            'password' => [ 'required', 'min:5', 'confirmed' ],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.current_password' => 'Current Password is invalid!',
        ];
    }
}
