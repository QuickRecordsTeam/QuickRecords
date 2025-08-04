<?php

namespace App\Observers;

use App\Models\MemberInvitation;
use Illuminate\Support\Facades\Auth;

class MemberInvitationObserver
{
    /**
     * Handle the MemberInvitation "created" event.
     *
     * @param  \App\Models\MemberInvitation  $memberInvitation
     * @return void
     */
    public function created(MemberInvitation $memberInvitation)
    {
        $memberInvitation->created_by = auth::user()->id;
    }

    /**
     * Handle the MemberInvitation "updated" event.
     *
     * @param  \App\Models\MemberInvitation  $memberInvitation
     * @return void
     */
    public function updated(MemberInvitation $memberInvitation)
    {
        $memberInvitation->updated_by = auth::user()->id;
    }

    /**
     * Handle the MemberInvitation "deleted" event.
     *
     * @param  \App\Models\MemberInvitation  $memberInvitation
     * @return void
     */
    public function deleted(MemberInvitation $memberInvitation)
    {
        $memberInvitation->deleted_by = auth::user()->id;
    }

    /**
     * Handle the MemberInvitation "restored" event.
     *
     * @param  \App\Models\MemberInvitation  $memberInvitation
     * @return void
     */
    public function restored(MemberInvitation $memberInvitation)
    {
        //
    }

    /**
     * Handle the MemberInvitation "force deleted" event.
     *
     * @param  \App\Models\MemberInvitation  $memberInvitation
     * @return void
     */
    public function forceDeleted(MemberInvitation $memberInvitation)
    {
        //
    }
}
