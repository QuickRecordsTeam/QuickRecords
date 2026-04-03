<?php


namespace App\Services;


use App\Constants\SessionStatus;
use App\Http\Resources\SessionResource;
use App\Http\Resources\SessionResourceCollection;
use App\Interfaces\SessionInterface;
use App\Models\Session;


class SessionService implements SessionInterface
{


    public function getAllSessions($request)
    {
        $organisation = $request->user()->organisation;
        $sessions = Session::where('organisation_id', $organisation->id)->orderBy('created_at', 'DESC')->get();
        return SessionResource::collection($sessions->toArray());
    }
    public function getCurrentSession()
    {
        $session = Session::where('status', SessionStatus::ACTIVE)->first();
        return new SessionResource($session);
    }

    public function createSession($request)
    {
        $user = $request->user();
        $organisation = $user->organisation;
        $previousSession =  Session::where('organisation_id', $organisation->id)->where('status', SessionStatus::ACTIVE)->first();
        if(isset($previousSession)) {
            $previousSession->status = SessionStatus::IN_ACTIVE;
            $previousSession->save();
        }

        Session::create([
            'year'          => $request->year,
            'status'        => SessionStatus::ACTIVE,
            'updated_by'    => $user->name,
            'organisation_id' => $organisation->id
        ]);
    }

    public function updateSession($request, $id)
    {
        $organisation = $request->user()->organisation;
        $currentSession =  Session::where('organisation_id', $organisation->id)->where('status', SessionStatus::ACTIVE)->first();
        $updatedSession = Session::findOrFail($id);

        if(SessionStatus::ACTIVE == $request->status && $request->year != $currentSession->year){
            $currentSession->status = SessionStatus::IN_ACTIVE;
            $currentSession->save();

        }
        $updatedSession->update([
            'status' => $request->status
        ]);


    }

    public function deleteSession($id)
    {
        return Session::findOrFail($id)->delete();
    }

    public function getSessionByLabel($label)
    {
        return Session::where('year', $label)->first();
    }

    public function getPaginatedSessions($request)
    {
        $sessions = Session::where('organisation_id', $request->user()->organisation->id)->orderBy('year')->paginate($request->per_page);

        return new SessionResourceCollection($sessions, $sessions->total(), $sessions->lastPage(), (int)$sessions->perPage(), $sessions->currentPage());
    }

    public function getSessionById($id)
    {
        return Session::findOrFail($id);
    }
}
