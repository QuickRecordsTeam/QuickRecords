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
           "payment_method" => "required|string",
           "description" => "nullable|string",
           "transaction_number" => "required|string|regex:/^237\d{9}$/",
           'subscription_id' => 'required|exists:subscriptions,id',
           'login_id' => 'required|exists:users,id',
           'billing_duration' => 'required|numeric'
        ];
    }
}
