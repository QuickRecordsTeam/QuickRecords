<?php

namespace App\Observers;

use App\Models\UserContribution;
use Illuminate\Support\Facades\Auth;

class UserContributionObserver
{
    /**
     * Handle the UserContribution "created" event.
     *
     * @param  \App\Models\UserContribution  $userContribution
     * @return void
     */
    public function created(UserContribution $userContribution)
    {
        $userContribution->created_by = auth::user()->id;
    }

    /**
     * Handle the UserContribution "updated" event.
     *
     * @param  \App\Models\UserContribution  $userContribution
     * @return void
     */
    public function updated(UserContribution $userContribution)
    {
        $userContribution->deleted_by = auth::user()->id;
    }

    /**
     * Handle the UserContribution "deleted" event.
     *
     * @param  \App\Models\UserContribution  $userContribution
     * @return void
     */
    public function deleted(UserContribution $userContribution)
    {
        $userContribution->deleted_by = auth::user()->id;
    }

    /**
     * Handle the UserContribution "restored" event.
     *
     * @param  \App\Models\UserContribution  $userContribution
     * @return void
     */
    public function restored(UserContribution $userContribution)
    {
        //
    }

    /**
     * Handle the UserContribution "force deleted" event.
     *
     * @param  \App\Models\UserContribution  $userContribution
     * @return void
     */
    public function forceDeleted(UserContribution $userContribution)
    {
        //
    }
}
