<?php

namespace App\Http\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;

abstract class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
        return [

            'offer' => [ 'nullable', 'string', 'max:50' ],
            'title' => [ 'required', 'string', 'max:255' ],
            'sub_title' => [ 'required', 'string', 'max:255' ],
            'short_description' => [ 'required', 'string',  ],
            'button_link' => [ 'nullable', 'string', 'max:255' ],
            'status' => [ 'boolean' ],
        ];
    }
}
