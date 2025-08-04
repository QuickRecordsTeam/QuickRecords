<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberPaymentItemContributionResource extends JsonResource
{

    private $id;
    private $name;
    private $item_amount;
    private $amount_deposited;
    private $code;
    private $balance;
    private $compulsory;
    private $type;
    private $frequency;
    private $payment_durations;
    private $created_at;
    private $reference;
    private $is_range;
    private $start_amount;
    private $end_amount;
    public function __construct($resource, $id, $name, $amount_deposited, $item_amount, $balance, $code, $compulsory, $type, $frequency, $payment_durations, $created_at, $reference, $is_range, $start_amount, $end_amount)
    {
        parent::__construct($resource);
        $this->id = $id;
        $this->amount_deposited = $amount_deposited;
        $this->name = $name;
        $this->item_amount = $item_amount;
        $this->code = $code;
        $this->balance = $balance;
        $this->compulsory = $compulsory;
        $this->type = $type;
        $this->frequency = $frequency;
        $this->payment_durations = $payment_durations;
        $this->created_at = $created_at;
        $this->reference = $reference;
        $this->start_amount = $start_amount;
        $this->is_range = $is_range;
        $this->end_amount = $end_amount;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'amount_deposited'  => $this->amount_deposited,
            'amount'            => $this->item_amount,
            'code'              => $this->code,
            'balance'           => $this->balance,
            'compulsory'        => $this->compulsory,
            'type'              => $this->type,
            'frequency'         => $this->frequency,
            'payment_durations' => $this->payment_durations,
            'created_at'        => $this->created_at,
            'reference'         => $this->reference,
            'is_range'          => $this->is_range,
            'start_amount'      => $this->start_amount,
            'end_amount'        => $this->end_amount
        ];
    }
}
