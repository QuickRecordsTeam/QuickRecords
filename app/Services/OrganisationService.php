<?php

namespace App\Services;

use App\Constants\Roles;
use App\Http\Resources\OrganisationResource;
use App\Interfaces\OrganisationInterface;
use App\Models\Organisation;
use App\Traits\HelpTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganisationService implements OrganisationInterface
{
    use HelpTrait;
    private RoleService $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
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
        $user =  $this->getRequestUser();
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

        $this->updateAdminUserRole($user, $organisation);

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

    private function updateAdminUserRole($user, $organisation)
    {
        $adminRole = $this->roleService->findRole(Roles::ADMIN);
        $memberRole = $this->roleService->findRole(Roles::MEMBER);
        $userRoles  = [$adminRole->id, $memberRole->id];

        foreach ($userRoles as $roleId) {
            DB::table('model_has_roles')->updateOrInsert(
                [
                    'model_id' => $user->id,
                    'role_id' => $roleId,
                    'model_type' => 'App\Models\User'
                ],
                [
                    'organisation_id' => $organisation->id,
                ]
            );
        }

    }
}
