<?php

namespace App\Observers;

use App\Models\ExpenditureCategory;
use Illuminate\Support\Facades\Auth;

class ExpenditureCategoryObserver
{
    /**
     * Handle the ExpenditureCategory "created" event.
     *
     * @param  \App\Models\ExpenditureCategory  $expenditureCategory
     * @return void
     */
    public function created(ExpenditureCategory $expenditureCategory)
    {
        $expenditureCategory->created_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureCategory "updated" event.
     *
     * @param  \App\Models\ExpenditureCategory  $expenditureCategory
     * @return void
     */
    public function updated(ExpenditureCategory $expenditureCategory)
    {
        $expenditureCategory->updated_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureCategory "deleted" event.
     *
     * @param  \App\Models\ExpenditureCategory  $expenditureCategory
     * @return void
     */
    public function deleted(ExpenditureCategory $expenditureCategory)
    {
        $expenditureCategory->deleted_by = auth::user()->id;
    }

    /**
     * Handle the ExpenditureCategory "restored" event.
     *
     * @param  \App\Models\ExpenditureCategory  $expenditureCategory
     * @return void
     */
    public function restored(ExpenditureCategory $expenditureCategory)
    {
        //
    }

    /**
     * Handle the ExpenditureCategory "force deleted" event.
     *
     * @param  \App\Models\ExpenditureCategory  $expenditureCategory
     * @return void
     */
    public function forceDeleted(ExpenditureCategory $expenditureCategory)
    {
        //
    }
}
