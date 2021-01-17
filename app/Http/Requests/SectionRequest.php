<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
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
                'author' => ['required', 'min:3', 'max:255', Rule::unique('sections', 'author')],
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return array_merge(
                [
                    'author' => ['sometimes', 'min:3', 'max:255', Rule::unique('sections', 'author')->ignore($this->section)],
                ],
                validateMultiLang(
                    [
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
    public function messages()
    {
        return [
            'author.required' => 'Section Name is required',
        ];
    }


}
