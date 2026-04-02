<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientVerificationResource extends JsonResource
{
    public function __construct($resource)
    {
        return parent::__construct($resource);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->resource->id,
            'username'  => $this->resource->username,
            'email' => $this->resource->email,
            'name'  => $this->resource->name,
            'has_organisation' => isset($this->resource->organisation),
            'organisation_id'      =>  isset($this->resource->organisation) ? $this->resource->organisation->id : null,
            'organisation_name'      =>  isset($this->resource->organisation) ? $this->resource->organisation->name : null,
            'organisation_email'      =>  isset($this->resource->organisation) ? $this->resource->organisation->email : null,
            'organisation_telephone'      =>  isset($this->resource->organisation) ? $this->resource->organisation->telephone : null,
            'organisation_address'      =>  isset($this->resource->organisation) ? $this->resource->organisation->address : null,
            'organisation_salutation'      =>  isset($this->resource->organisation) ? $this->resource->organisation->salutation : null,
            'organisation_region'      =>  isset($this->resource->organisation) ? $this->resource->organisation->region : null,
            'organisation_box_number'      =>  isset($this->resource->organisation) ? $this->resource->organisation->box_number : null,
            'organisation_logo'      =>  isset($this->resource->organisation) ? $this->resource->organisation->logo : null,
            'organisation_description'      =>  isset($this->resource->organisation) ? $this->resource->organisation->description : null,

            'subscriptions' => (isset($this->resource->organisation)) ? SubscriptionResource::collection($this->resource->organisation->subscriptions) : []

        ];
    }
}
