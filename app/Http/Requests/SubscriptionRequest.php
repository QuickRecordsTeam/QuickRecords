<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'organisation_id' => 'required|exists:organisations,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'auto_renewal' => 'required|boolean',
            'is_trial' => 'required|boolean',
            'referral_code' => 'nullable|string|exists:organisations,referral_code',
        ];
    }

    public function messages()
    {
        return [
            'referral_code.exists' => 'The provided referral code is invalid'
        ];
    }
}
