<?php

namespace App\Http\Requests;

use App\Rules\AmountPaymentItemValidator;
use App\Rules\EndRangeAmountPaymentItemValidator;
use App\Rules\RangePaymentItemValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentItemRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'amount'        => new AmountPaymentItemValidator,
            'compulsory'    => 'required|boolean',
            'description'   => 'max:4000',
            'type'          => 'required|string',
            'frequency'     => 'required|string',
            'reference'     => '',
            'deadline'      => 'required|date',
            'is_range'      => 'required|boolean',
            'start_amount'   => new RangePaymentItemValidator,
            'end_amount'     => [new RangePaymentItemValidator, new EndRangeAmountPaymentItemValidator]
        ];
    }
}
