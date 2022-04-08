<?php

namespace Bendt\Option\Data\Option;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Throwables\HttpResponseException;

class RequestUpdateOption extends FormRequest
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
            'name' => 'required|max:150',
			'description' => 'max:65500',
			'is_active' => 'required|in:0,1',
			'is_modifiable' => '',
        ];
    }

    /**
     * Failed validation disable redirect
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
