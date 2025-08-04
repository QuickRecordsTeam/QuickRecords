<?php

namespace App\Observers;

use App\Models\ActivitySupport;
use Illuminate\Support\Facades\Auth;

class ActivitySupportObserver
{
    /**
     * Handle the ActivitySupport "created" event.
     *
     * @param  \App\Models\ActivitySupport  $activitySupport
     * @return void
     */
    public function created(ActivitySupport $activitySupport)
    {
        $activitySupport->created_by = auth::user()->id;
    }

    /**
     * Handle the ActivitySupport "updated" event.
     *
     * @param  \App\Models\ActivitySupport  $activitySupport
     * @return void
     */
    public function updated(ActivitySupport $activitySupport)
    {
        $activitySupport->updated_by = auth::user()->id;
    }

    /**
     * Handle the ActivitySupport "deleted" event.
     *
     * @param  \App\Models\ActivitySupport  $activitySupport
     * @return void
     */
    public function deleted(ActivitySupport $activitySupport)
    {
        $activitySupport->deleted_by = auth::user()->id;
    }

    /**
     * Handle the ActivitySupport "restored" event.
     *
     * @param  \App\Models\ActivitySupport  $activitySupport
     * @return void
     */
    public function restored(ActivitySupport $activitySupport)
    {
        //
    }

    /**
     * Handle the ActivitySupport "force deleted" event.
     *
     * @param  \App\Models\ActivitySupport  $activitySupport
     * @return void
     */
    public function forceDeleted(ActivitySupport $activitySupport)
    {
        //
    }
}
