<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitPaymentRequest extends FormRequest
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
           "amount" => "required|numeric|min:1",
           "payment_method" => "required|string",
           "description" => "nullable|string",
           "account_number" => "required|string|regex:/^\d{9}$/",
           'subscription_id' => 'required|exists:subscriptions,id',
           'login_id' => 'required|exists:users,id',
        ];
    }
}
