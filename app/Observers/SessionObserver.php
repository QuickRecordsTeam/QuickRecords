<?php

namespace App\Observers;

use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class SessionObserver
{
    /**
     * Handle the Session "created" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function created(Session $session)
    {
        $session->created_by = auth::user()->id;
    }

    /**
     * Handle the Session "updated" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function updated(Session $session)
    {
        $session->updated_by = auth::user()->id;
    }

    /**
     * Handle the Session "deleted" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function deleted(Session $session)
    {

        $session->deleted_by = auth::user()->id;
    }

    /**
     * Handle the Session "restored" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function restored(Session $session)
    {
        //
    }

    /**
     * Handle the Session "force deleted" event.
     *
     * @param  \App\Models\Session  $session
     * @return void
     */
    public function forceDeleted(Session $session)
    {
        //
    }
}
