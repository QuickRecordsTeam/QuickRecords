<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    private $org_admin_id;
    public function __construct($resource, $org_admin_id = null)
    {
        $this->org_admin_id = $org_admin_id;
        return parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'organisation' => $this->organisation,
            'subscription_plan' => $this->subscriptionPlan,
            'auto_renewal' => $this->auto_renewal,
            'referral_code_discount' => (int) $this->referral_code_discount,
            'current_period_start_date' => $this->current_period_start_date,
            'current_period_end_date' => $this->current_period_end_date,
            'status' => $this->status,
            'trial_period_end_date' => $this->trial_period_end_date,
            'trial_period_start_date' => $this->trial_period_start_date,
            'is_trail' => $this->is_trail,
            'login_id'  => $this->org_admin_id
        ];
    }
}
