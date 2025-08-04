<?php

namespace App\Observers;

use App\Models\UserSaving;
use Illuminate\Support\Facades\Auth;

class UserSavingObserver
{
    /**
     * Handle the UserSaving "created" event.
     *
     * @param  \App\Models\UserSaving  $userSaving
     * @return void
     */
    public function created(UserSaving $userSaving)
    {
        $userSaving->created_by = auth::user()->id;
    }

    /**
     * Handle the UserSaving "updated" event.
     *
     * @param  \App\Models\UserSaving  $userSaving
     * @return void
     */
    public function updated(UserSaving $userSaving)
    {
        $userSaving->updated_by = auth::user()->id;
    }

    /**
     * Handle the UserSaving "deleted" event.
     *
     * @param  \App\Models\UserSaving  $userSaving
     * @return void
     */
    public function deleted(UserSaving $userSaving)
    {
        $userSaving->deleted_by = auth::user()->id;
    }

    /**
     * Handle the UserSaving "restored" event.
     *
     * @param  \App\Models\UserSaving  $userSaving
     * @return void
     */
    public function restored(UserSaving $userSaving)
    {
        //
    }

    /**
     * Handle the UserSaving "force deleted" event.
     *
     * @param  \App\Models\UserSaving  $userSaving
     * @return void
     */
    public function forceDeleted(UserSaving $userSaving)
    {
        //
    }
}
