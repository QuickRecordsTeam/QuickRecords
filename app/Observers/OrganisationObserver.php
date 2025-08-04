<?php

namespace App\Observers;

use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class OrganisationObserver
{
    /**
     * Handle the Ogranisation "created" event.
     *
     * @param  \App\Models\Ogranisation  $ogranisation
     * @return void
     */
    public function created(Organisation $ogranisation)
    {
        $ogranisation->created_by = auth::user()->id;
    }

    /**
     * Handle the Ogranisation "updated" event.
     *
     * @param  \App\Models\Ogranisation  $ogranisation
     * @return void
     */
    public function updated(Organisation $ogranisation)
    {
        $ogranisation->updated_by = auth::user()->id;
    }

    /**
     * Handle the Ogranisation "deleted" event.
     *
     * @param  \App\Models\Ogranisation  $ogranisation
     * @return void
     */
    public function deleted(Organisation $ogranisation)
    {
        $ogranisation->deleted_by = auth::user()->id;
    }

    /**
     * Handle the Ogranisation "restored" event.
     *
     * @param  \App\Models\Ogranisation  $ogranisation
     * @return void
     */
    public function restored(Organisation $ogranisation)
    {
        //
    }

    /**
     * Handle the Ogranisation "force deleted" event.
     *
     * @param  \App\Models\Ogranisation  $ogranisation
     * @return void
     */
    public function forceDeleted(Organisation $ogranisation)
    {
        //
    }
}
