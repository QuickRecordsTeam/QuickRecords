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
            'subscriptions' => (isset($this->resource->organisation)) ? SubscriptionResource::collection($this->resource->organisation->subscriptions) : []

        ];
    }
}
