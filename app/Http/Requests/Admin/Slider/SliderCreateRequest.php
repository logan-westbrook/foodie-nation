<?php

namespace App\Http\Requests\Admin\Slider;


class SliderCreateRequest extends SliderRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [ 'image' => [ 'required', 'image', 'max:10000' ] ]
        );
    }
}
