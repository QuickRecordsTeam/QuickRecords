<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPlanRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'discount_percentage' => 'required|nullable|numeric|min:0|max:100',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string|max:255',
            'billing_cycle' => 'required|in:monthly,yearly',
            'is_discount_applicable' => 'required|boolean',
            'trial_duration_days' => 'required|nullable|integer|min:0',
        ];
    }
}
