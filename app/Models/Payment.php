<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use GenerateUuid;

    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'subscription_id',
        'amount',
        'payment_method',
        'transaction_status',
        'payment_date',
        'transaction_number'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function computeSubscriptionPaymentChargeFee()
    {
        $feePercentage = env('PAYMENT_CHARGE_FEE_PERCENTAGE', 0.02);
        if ($this->subscription->subscriptionPlan->is_discount_applicable) {
            $discountAmount = $this->subscription->getSubscriptionDiscountCost();
            $amountAfterDiscount = $this->amount - $discountAmount;
            return $amountAfterDiscount * $feePercentage;
        }
        if ($this->subscription->referral_code_discount_percentage) {
            $discountAmount = ($this->amount * $this->subscription->referral_code_discount_percentage) / 100;
            $amountAfterDiscount = $this->amount - $discountAmount;
            return $amountAfterDiscount * $feePercentage;
        }
        return $this->amount * $feePercentage;
    }
}
