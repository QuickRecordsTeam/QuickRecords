<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentCallbackRequest extends FormRequest
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
            'status' => 'required|string',
            'reference' => 'required|string',
            'currency' => 'required|string',
            'amount' => 'required|numeric',
            'operator' => 'required|string',
            'code'  => 'required|string',
            'operator_reference' => 'required|string',
            'signature' => 'required|string',
            'endpoint' => 'required|string',
            'external_reference' => 'required|string',
            'external_user' => 'required|string',
            'extra_first_name' => 'nullable|string',
            'extra_last_name' => 'nullable|string',
            'extra_email' => 'nullable|email',
            'phone_number' => 'required|string',
        ];
    }
}
