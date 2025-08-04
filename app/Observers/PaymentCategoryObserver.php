<?php

namespace App\Observers;

use App\Models\PaymentCategory;
use Illuminate\Support\Facades\Auth;

class PaymentCategoryObserver
{
    /**
     * Handle the PaymentCategory "created" event.
     *
     * @param  \App\Models\PaymentCategory  $paymentCategory
     * @return void
     */
    public function created(PaymentCategory $paymentCategory)
    {
        $paymentCategory->created_by = auth::user()->id;
    }

    /**
     * Handle the PaymentCategory "updated" event.
     *
     * @param  \App\Models\PaymentCategory  $paymentCategory
     * @return void
     */
    public function updated(PaymentCategory $paymentCategory)
    {
        $paymentCategory->updated_by = auth::user()->id;
    }

    /**
     * Handle the PaymentCategory "deleted" event.
     *
     * @param  \App\Models\PaymentCategory  $paymentCategory
     * @return void
     */
    public function deleted(PaymentCategory $paymentCategory)
    {
        $paymentCategory->deleted_by = auth::user()->id;
    }

    /**
     * Handle the PaymentCategory "restored" event.
     *
     * @param  \App\Models\PaymentCategory  $paymentCategory
     * @return void
     */
    public function restored(PaymentCategory $paymentCategory)
    {
        //
    }

    /**
     * Handle the PaymentCategory "force deleted" event.
     *
     * @param  \App\Models\PaymentCategory  $paymentCategory
     * @return void
     */
    public function forceDeleted(PaymentCategory $paymentCategory)
    {
        //
    }
}
