<?php

namespace App\Http\Requests\Admin\Profile;

use App\Http\Requests\ProfileAvatarRequest;

class ProfileUpdateRequest extends ProfileAvatarRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'name' => [ 'required', 'max:50' ],
            'email' => [ 'required', 'email', 'max:200', 'unique:users,email,' . auth()->user()->id ],
        ]);
    }
}
