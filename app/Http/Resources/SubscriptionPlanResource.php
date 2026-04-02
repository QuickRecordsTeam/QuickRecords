<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'price' => (float) $this->price,
            'discount_percentage' => $this->discount_percentage,
            'features' => explode(',', $this->features),
            'billing_cycle' => $this->billing_cycle,
            'is_discount_applicable' => $this->is_discount_applicable,
            'trial_duration_days' => $this->trial_duration_days,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
