<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrganisationRequest extends FormRequest
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
        $rules = [
            'name'          => 'required|max:255',
            'email'         => ['email'],
            'address'       => 'required',
            'description'   => 'required|max:5000',//The frontend sent this as mission but it is more of a description of the organisation
            'region'        => 'string',
            'telephone'     => 'required',//should be a string separated by /
            'id'            => ['nullable'],
        ];
         isset($this->id) ? $rules['id'][] = 'exists:organisations,id': $rules['email'][] = 'unique:organisations,email';

        return $rules;
    }
}
