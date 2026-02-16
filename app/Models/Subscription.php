<?php

namespace App\Models;

use App\Constants\BillingCyclePlans;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use GenerateUuid;

    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'organisation_id',
        'subscription_plan_id',
        'auto_renewal',
        'referral_code_discount',
        'current_period_start_date',
        'current_period_end_date',
        'status',
        'trial_period_end_date',
        'trial_period_start_date',
        'is_trail'

    ];
    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getSubscriptionDiscountCost()
    {
        if ($this->referral_code_discount_percentage) {
            $discountAmount = ($this->subscriptionPlan->price * $this->referral_code_discount_percentage) / 100;
            return $discountAmount;
        }
        return 0;
    }


}
