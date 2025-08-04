<?php

namespace App\Observers;

use App\Models\ExpenditureItem;
use Illuminate\Support\Facades\Auth;

class ExpenditureItemObserver
{
    /**
     * Handle the ExpenditureItem "created" event.
     *
     * @param  \App\Models\ExpenditureItem  $expenditureItem
     * @return void
     */
    public function created(ExpenditureItem $expenditureItem)
    {
        $expenditureItem->created_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureItem "updated" event.
     *
     * @param  \App\Models\ExpenditureItem  $expenditureItem
     * @return void
     */
    public function updated(ExpenditureItem $expenditureItem)
    {
        $expenditureItem->updated_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureItem "deleted" event.
     *
     * @param  \App\Models\ExpenditureItem  $expenditureItem
     * @return void
     */
    public function deleted(ExpenditureItem $expenditureItem)
    {
        $expenditureItem->deleted = auth::user()->id;
    }

    /**
     * Handle the ExpenditureItem "restored" event.
     *
     * @param  \App\Models\ExpenditureItem  $expenditureItem
     * @return void
     */
    public function restored(ExpenditureItem $expenditureItem)
    {
        //
    }

    /**
     * Handle the ExpenditureItem "force deleted" event.
     *
     * @param  \App\Models\ExpenditureItem  $expenditureItem
     * @return void
     */
    public function forceDeleted(ExpenditureItem $expenditureItem)
    {
        //
    }
}
