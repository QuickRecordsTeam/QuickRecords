<?php

namespace App\Services;

use App\Exceptions\BusinessValidationException;
use App\Http\Resources\OrganisationResource;
use App\Interfaces\OrganisationInterface;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrganisationService implements OrganisationInterface
{
    public function updateOrganisationInfo($request)
    {
        $organisation = Organisation::find($request->id);
        if (!is_null($organisation)) {
            $organisation->name             = $request->name;
            $organisation->email            = $request->email;
            $organisation->telephone        = $request->telephone;
            $organisation->description      = $request->description;
            $organisation->address          = $request->address;
            $organisation->salutation       = $request->salutation;
            $organisation->box_number       = $request->box_number;
            $organisation->updated_by       = $request->user()->name;

            $organisation->save();
        }
        return $organisation;
    }

    public function createOrganisationAccount($request)
    {

        $user =  $request->user();
        $organisation = Organisation::firstOrCreate(
            [
                'id' => $request['id']
            ],
            [
                'name'             => $request->name,
                'email'            => $request->email,
                'telephone'        => $request->telephone,
                'description'      => $request->description,
                'address'          => $request->address,
                'salutation'       => "",
                'box_number'       => 0000,
                'created_by'       => $user->id,
                'region'           => $request->region,
                'referral_code'    => $this->generateReferralCode(),
            ]
        );

        $user->update([
            'organisation_id' => $organisation->id
        ]);

        return new OrganisationResource($organisation, $user->id, $user->username, $user->name);
    }

    public function getOrganisation($id)
    {
        return Organisation::findOrFail($id);
    }

    public function getOrganisationInfo()
    {
        $id = null;
        if (!is_null(Auth::user()->organisation)) {
            $id = Auth::user()->organisation->id;
        }
        return Organisation::findOrFail($id);
    }

    public function updatedOrganisation($request, $id)
    {
        $updated =  Organisation::findOrFail($id);
        $updated->update([
            'logo'             => $request->logo,
        ]);

        return $updated;
    }

    public function deleteOgranisation($id)
    {
        Organisation::findOrFail($id)->delete();
    }

    public function getOrganisations()
    {
        return Organisation::all();
    }

    public function updateTelephoneNumber($request)
    {
        $organisation = Organisation::findOrFail($request->id);
        $organisation->update([
            'telephone' => $request->telephone
        ]);
    }

    public function generateReferralCode($length = 4)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $referralCode = 'REF-';
        for ($i = 0; $i < $length; $i++) {
            $referralCode .= $characters[rand(0, $charactersLength - 1)];
        }
        return $referralCode;
    }
}
