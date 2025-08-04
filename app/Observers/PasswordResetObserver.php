<?php

namespace App\Observers;

use App\Models\PasswordReset;
use Illuminate\Support\Facades\Auth;


class PasswordResetObserver
{
    /**
     * Handle the PasswordReset "created" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function created(PasswordReset $passwordReset)
    {
        $passwordReset->created_by = auth::user()->id;
    }

    /**
     * Handle the PasswordReset "updated" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function updated(PasswordReset $passwordReset)
    {
        $passwordReset->updated_by = auth::user()->id;
    }

    /**
     * Handle the PasswordReset "deleted" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function deleted(PasswordReset $passwordReset)
    {
        $passwordReset->deleted_by = auth::user()->id;
    }

    /**
     * Handle the PasswordReset "restored" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function restored(PasswordReset $passwordReset)
    {
        //
    }

    /**
     * Handle the PasswordReset "force deleted" event.
     *
     * @param  \App\Models\PasswordReset  $passwordReset
     * @return void
     */
    public function forceDeleted(PasswordReset $passwordReset)
    {
        //
    }
}
