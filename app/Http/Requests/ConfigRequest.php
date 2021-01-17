<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfigRequest extends FormRequest
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

        if ($this->isMethod('POST')) {
            return [
                'author' => ['required', 'min:3', 'max:255', Rule::unique('services', 'author')],
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return array_merge(
                [
                    'author' => ['sometimes', 'min:3', 'max:255', Rule::unique('services', 'author')->ignore($this->service)],
                ],
                validateMultiLang(
                    [
                        'config_name' => ['sometimes', 'max:255',],
                        'config_value' => ['sometimes']
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
    public function messages()
    {
        return [
            'author.required' => 'Config Name is required',
        ];
    }


}
