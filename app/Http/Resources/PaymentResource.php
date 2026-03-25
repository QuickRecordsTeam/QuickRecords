<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'subscription' => $this->subscription,
            'organisation' => $this->subscription->organisation,
            'subscriptionPlan' => $this->subscription->subscriptionPlan,
            'amount' => (float)$this->amount,
            'payment_method' => $this->payment_method,
            'transaction_status' => $this->transaction_status,
            'payment_date' => $this->payment_date,
            'transaction_number' => $this->transaction_number,
            'transaction_id' => $this->transaction_id,
            'description' => $this->description,
            'external_transaction_id' => $this->external_transaction_id,
            'financial_transaction_id' => $this->financial_transaction_id,
        ];
    }
}
