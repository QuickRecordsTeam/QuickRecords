<?php

namespace App\Observers;

use App\Models\IncomeActivity;
use Illuminate\Support\Facades\Auth;

class IncomeActivityObserver
{
    /**
     * Handle the IncomeActivity "created" event.
     *
     * @param  \App\Models\IncomeActivity  $incomeActivity
     * @return void
     */
    public function created(IncomeActivity $incomeActivity)
    {
        $incomeActivity->created_by = auth::user()->id;
    }

    /**
     * Handle the IncomeActivity "updated" event.
     *
     * @param  \App\Models\IncomeActivity  $incomeActivity
     * @return void
     */
    public function updated(IncomeActivity $incomeActivity)
    {
        $incomeActivity->updated_by = auth::user()->id;
    }

    /**
     * Handle the IncomeActivity "deleted" event.
     *
     * @param  \App\Models\IncomeActivity  $incomeActivity
     * @return void
     */
    public function deleted(IncomeActivity $incomeActivity)
    {
        $incomeActivity->deleted_by = auth::user()->id;
    }

    /**
     * Handle the IncomeActivity "restored" event.
     *
     * @param  \App\Models\IncomeActivity  $incomeActivity
     * @return void
     */
    public function restored(IncomeActivity $incomeActivity)
    {
        //
    }

    /**
     * Handle the IncomeActivity "force deleted" event.
     *
     * @param  \App\Models\IncomeActivity  $incomeActivity
     * @return void
     */
    public function forceDeleted(IncomeActivity $incomeActivity)
    {
        //
    }
}
