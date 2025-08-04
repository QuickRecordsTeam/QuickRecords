<?php

namespace App\Observers;

use App\Models\TransactionHistory;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryObserver
{
    /**
     * Handle the TransactionHistory "created" event.
     *
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return void
     */
    public function created(TransactionHistory $transactionHistory)
    {
        $transactionHistory->created_by = auth::user()->id;
    }

    /**
     * Handle the TransactionHistory "updated" event.
     *
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return void
     */
    public function updated(TransactionHistory $transactionHistory)
    {
        $transactionHistory->updated_by = auth::user()->id;
    }

    /**
     * Handle the TransactionHistory "deleted" event.
     *
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return void
     */
    public function deleted(TransactionHistory $transactionHistory)
    {
        $transactionHistory->deleted_by = auth::user()->id;
    }

    /**
     * Handle the TransactionHistory "restored" event.
     *
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return void
     */
    public function restored(TransactionHistory $transactionHistory)
    {
        //
    }

    /**
     * Handle the TransactionHistory "force deleted" event.
     *
     * @param  \App\Models\TransactionHistory  $transactionHistory
     * @return void
     */
    public function forceDeleted(TransactionHistory $transactionHistory)
    {
        //
    }
}
