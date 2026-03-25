<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use GenerateUuid;


    protected $primaryKey = 'id';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'name',
        'status',
        'price',
        'discount_percentage',
        'features',
        'billing_cycle',
        'is_discount_applicable',
        'trial_duration_days'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function getFeaturesListAttribute()
    {
        return $this->features ? explode(',', $this->features) : [];
    }

    public function calculateDiscountedPrice()
    {
        if ($this->is_discount_applicable && $this->discount_percentage) {
            return $this->price - ($this->price * ($this->discount_percentage / 100));
        }
        return $this->price;
    }
}
