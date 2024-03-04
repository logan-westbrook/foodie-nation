<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\ProfilePasswordRequest;

class ProfilePasswordUpdateRequest extends ProfilePasswordRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}