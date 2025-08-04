<?php

namespace App\Observers;

use App\Models\StoreYearlyBalance;
use Illuminate\Support\Facades\Auth;

class StoreYealyBalanceObserver
{
    /**
     * Handle the StoreYearlyBalance "created" event.
     *
     * @param  \App\Models\StoreYearlyBalance  $storeYearlyBalance
     * @return void
     */
    public function created(StoreYearlyBalance $storeYearlyBalance)
    {
        $storeYearlyBalance->created_by = auth::user()->id;
    }

    /**
     * Handle the StoreYearlyBalance "updated" event.
     *
     * @param  \App\Models\StoreYearlyBalance  $storeYearlyBalance
     * @return void
     */
    public function updated(StoreYearlyBalance $storeYearlyBalance)
    {
        $storeYearlyBalance->updated_by = auth::user()->id;
    }

    /**
     * Handle the StoreYearlyBalance "deleted" event.
     *
     * @param  \App\Models\StoreYearlyBalance  $storeYearlyBalance
     * @return void
     */
    public function deleted(StoreYearlyBalance $storeYearlyBalance)
    {
        $storeYearlyBalance->deleted_by = auth::user()->id;
    }

    /**
     * Handle the StoreYearlyBalance "restored" event.
     *
     * @param  \App\Models\StoreYearlyBalance  $storeYearlyBalance
     * @return void
     */
    public function restored(StoreYearlyBalance $storeYearlyBalance)
    {
        //
    }

    /**
     * Handle the StoreYearlyBalance "force deleted" event.
     *
     * @param  \App\Models\StoreYearlyBalance  $storeYearlyBalance
     * @return void
     */
    public function forceDeleted(StoreYearlyBalance $storeYearlyBalance)
    {
        //
    }
}
