<?php

namespace App\Observers;

use App\Models\MemberRegistration;
use Illuminate\Support\Facades\Auth;

class MemberRegistrationObserver
{
    /**
     * Handle the MemberRegistration "created" event.
     *
     * @param  \App\Models\MemberRegistration  $memberRegistration
     * @return void
     */
    public function created(MemberRegistration $memberRegistration)
    {
        $memberRegistration->created_by = auth::user()->id;
    }

    /**
     * Handle the MemberRegistration "updated" event.
     *
     * @param  \App\Models\MemberRegistration  $memberRegistration
     * @return void
     */
    public function updated(MemberRegistration $memberRegistration)
    {
        $memberRegistration->updated_by = auth::user()->id;
    }

    /**
     * Handle the MemberRegistration "deleted" event.
     *
     * @param  \App\Models\MemberRegistration  $memberRegistration
     * @return void
     */
    public function deleted(MemberRegistration $memberRegistration)
    {
        $memberRegistration->deleted_by = auth::user()->id;
    }

    /**
     * Handle the MemberRegistration "restored" event.
     *
     * @param  \App\Models\MemberRegistration  $memberRegistration
     * @return void
     */
    public function restored(MemberRegistration $memberRegistration)
    {
        //
    }

    /**
     * Handle the MemberRegistration "force deleted" event.
     *
     * @param  \App\Models\MemberRegistration  $memberRegistration
     * @return void
     */
    public function forceDeleted(MemberRegistration $memberRegistration)
    {
        //
    }
}
