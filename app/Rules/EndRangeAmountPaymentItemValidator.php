<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class EndRangeAmountPaymentItemValidator implements Rule, DataAwareRule
{
    protected $data = [];


    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (isset($this->data['is_range']) && $this->data['is_range'] == true) {
            return $this->data['start_amount'] < $value;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be greater than the start range.';
    }
}
