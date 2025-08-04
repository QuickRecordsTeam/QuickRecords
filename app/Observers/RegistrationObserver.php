<?php

namespace App\Observers;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class RegistrationObserver
{
    /**
     * Handle the Registration "created" event.
     *
     * @param  \App\Models\Registration  $registration
     * @return void
     */
    public function created(Registration $registration)
    {
        $registration->created_by = auth::user()->id;
    }

    /**
     * Handle the Registration "updated" event.
     *
     * @param  \App\Models\Registration  $registration
     * @return void
     */
    public function updated(Registration $registration)
    {
        $registration->updated_by = auth::user()->id;
    }

    /**
     * Handle the Registration "deleted" event.
     *
     * @param  \App\Models\Registration  $registration
     * @return void
     */
    public function deleted(Registration $registration)
    {
        $registration->deleted_by = auth::user()->id;
    }

    /**
     * Handle the Registration "restored" event.
     *
     * @param  \App\Models\Registration  $registration
     * @return void
     */
    public function restored(Registration $registration)
    {
        //
    }

    /**
     * Handle the Registration "force deleted" event.
     *
     * @param  \App\Models\Registration  $registration
     * @return void
     */
    public function forceDeleted(Registration $registration)
    {
        //
    }
}
