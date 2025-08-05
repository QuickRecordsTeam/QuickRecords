<?php

namespace App\Http\Resources;

use App\Models\PaymentItem;
use App\Models\User;
use App\Traits\HelpTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class UserContributionResource extends JsonResource
{

    use HelpTrait;
    public function toArray($request)
    {
        $payment_item = $this->paymentItem;
        $user = $this->user;


        return [
            'id'                       => $this->id,
            'code'                     => $this->code,
            'amount_deposited'         => $this->amount_deposited,
            'comment'                  => $this->comment,
            'status'                   => $this->status,
            'approve'                  => $this->approve,
            'user_id'                  => $this->user_id,
            'user_name'                => $user->name,
            'date'                     => $this->date,
            'user_telephone'           => $user->telephone,
            'user_email'               => $user->email,
            'payment_item_id'          => $payment_item->id,
            'payment_item_name'        => $payment_item->name,
            'payment_item_amount'      => $payment_item->is_range ? $payment_item->start_amount : $payment_item->amount,
            'payment_item_frequency'   => $payment_item->frequency,
            'payment_item_created_at'  => $payment_item->created_at,
            'payment_category'         => $payment_item->paymentCategory,
            'payment_item_compulsory'  => $payment_item->compulsory == 0 ? false : true,
            'balance'                  => $this->getBalance($payment_item, $this->total_amount_deposited, $this->balance),
            'updated_by'               => $this->updated_by,
            'created_at'               => $this->created_at,
            'total_amount_deposited'   => $this->total_amount_deposited == null ? 0 : $this->total_amount_deposited,
            'session_id'               => $this->session_id,
            'quarterly_name'           => $this->quarterly_name,
            'month_name'               => $this->month_name,
            'userContribution'         => $this->userContribution,
            'is_range'                 => $payment_item->is_range,
            'start_amount'             => $payment_item->start_amount,
            'end_amount'               => $payment_item->end_amount
        ];
    }

    private function getBalance($payment_item, $total_amount_deposited, $balance)
    {
        if ($total_amount_deposited !== null) {
            if ($payment_item->is_range && $total_amount_deposited > $payment_item->start_amount) {
                return 0;
            } else {
                return ($this->computeTotalPaymentItemAmount($payment_item) - $total_amount_deposited);
            }
        } else {
            return $balance;
        }
    }
}
