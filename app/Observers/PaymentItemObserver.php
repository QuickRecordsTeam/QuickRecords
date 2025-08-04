<?php

namespace App\Observers;

use App\Models\PaymentItem;
use Illuminate\Support\Facades\Auth;

class PaymentItemObserver
{
    /**
     * Handle the PaymentItem "created" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function created(PaymentItem $paymentItem)
    {
        $paymentItem->created_by = auth::user()->id;
    }

    /**
     * Handle the PaymentItem "updated" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function updated(PaymentItem $paymentItem)
    {
        $paymentItem->updated_by = auth::user()->id;
    }

    /**
     * Handle the PaymentItem "deleted" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function deleted(PaymentItem $paymentItem)
    {
        $paymentItem->deleted_by = auth::user()->id;
    }

    /**
     * Handle the PaymentItem "restored" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function restored(PaymentItem $paymentItem)
    {
        //
    }

    /**
     * Handle the PaymentItem "force deleted" event.
     *
     * @param  \App\Models\PaymentItem  $paymentItem
     * @return void
     */
    public function forceDeleted(PaymentItem $paymentItem)
    {
        //
    }
}
