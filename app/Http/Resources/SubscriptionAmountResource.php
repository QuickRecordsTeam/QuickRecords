<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionAmountResource extends JsonResource
{
    private $total_amount;
    private $chargeable_percentage;
    private $subscription_id;

    public function __construct($resource, $subscription_id, $total_amount, $chargeable_percentage)
    {
        parent::__construct($resource);
        $this->subscription_id = $subscription_id;
        $this->total_amount = $total_amount;
        $this->chargeable_percentage = $chargeable_percentage;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'subscription_id' => $this->id,
            'total_amount' => $this->total_amount,
            'chargeable_percentage' => $this->chargeable_percentage,
        ];
    }
}
