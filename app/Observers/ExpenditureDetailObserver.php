<?php

namespace App\Observers;

use App\Models\ExpenditureDetail;
use Illuminate\Support\Facades\Auth;

class ExpenditureDetailObserver
{
    /**
     * Handle the ExpenditureDetail "created" event.
     *
     * @param  \App\Models\ExpenditureDetail  $expenditureDetail
     * @return void
     */
    public function created(ExpenditureDetail $expenditureDetail)
    {
        $expenditureDetail->created_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureDetail "updated" event.
     *
     * @param  \App\Models\ExpenditureDetail  $expenditureDetail
     * @return void
     */
    public function updated(ExpenditureDetail $expenditureDetail)
    {
        $expenditureDetail->updated_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureDetail "deleted" event.
     *
     * @param  \App\Models\ExpenditureDetail  $expenditureDetail
     * @return void
     */
    public function deleted(ExpenditureDetail $expenditureDetail)
    {
        $expenditureDetail->deleted_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureDetail "restored" event.
     *
     * @param  \App\Models\ExpenditureDetail  $expenditureDetail
     * @return void
     */
    public function restored(ExpenditureDetail $expenditureDetail)
    {
        //
    }

    /**
     * Handle the ExpenditureDetail "force deleted" event.
     *
     * @param  \App\Models\ExpenditureDetail  $expenditureDetail
     * @return void
     */
    public function forceDeleted(ExpenditureDetail $expenditureDetail)
    {
        //
    }
}
