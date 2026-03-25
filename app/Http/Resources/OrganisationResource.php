<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class OrganisationResource extends JsonResource
{
    private $org_admin_user_id;
    private $adminUsername;
    private $adminName;
    public function __construct($resource, $org_admin_user_id = null, $adminUsername = null, $adminName = null)
    {
        parent::__construct($resource);
        $this->org_admin_user_id = $org_admin_user_id;
        $this->adminName = $adminName;
        $this->adminUsername = $adminUsername;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'telephone'     => $this->telephone,
            'box_number'    => $this->box_number,
            'address'       => $this->address,
            'description'   => $this->description,
            'region'        => $this->region,
            'logo'          => $this->logo,
            'salutation'    => $this->salutation,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'user_id'       => $this->org_admin_user_id,
            'subscriptions' => SubscriptionResource::collection($this->subscriptions),
            'adminName'     => $this->adminName,
            'adminUsername' => $this->adminUsername
        ];
    }
}
