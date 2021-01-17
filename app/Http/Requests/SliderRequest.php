<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SliderRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */

    public function authorize() {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */

    public function rules() {
        if ($this->isMethod('POST')) {
            return [
                'author' => ['required', 'min:3', 'max:255', Rule::unique('sliders', 'author')],
                'photo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:3072'],
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return array_merge(
                [
                    'author' => ['sometimes', 'min:3', 'max:255', Rule::unique('sliders', 'author')->ignore($this->slider)],
                    'photo'         => ['sometimes', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:3072'],
                ],
                validateMultiLang(
                    [
                        'title' => ['sometimes', 'nullable', 'max:255',],
                        'body' => ['sometimes', 'nullable']
                    ]
                )
            );
        }
    }

    /**
    * Rename Messages Of Errors
    *
    * @return array
    */

    public function messages() {
        return [
            'photo.required'=>'Photo is required',
            'author.required'=>'Slider name is required',
        ];
    }

}