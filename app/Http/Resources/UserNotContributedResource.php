<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserNotContributedResource extends JsonResource
{
    private $user_data;
    private $payment_item;
    public function __construct($user_data, $payment_item)
    {
        $this->user_data = $user_data;
        $this->payment_item = $payment_item;
    }
    public function toArray($request)
    {
        return [
            'user_data' => $this->user_data,
            'payment_item' => $this->payment_item,
            'total_balance' => 0,
            'total_deposited' => 0
        ];
    }
}
