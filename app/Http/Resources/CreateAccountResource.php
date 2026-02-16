<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateAccountResource extends JsonResource
{

    private $username;
    private $email;
    private $id;
    public function __construct($resource, $username = null, $email = null, $id = null)
    {
        parent::__construct($resource);
        $this->username = $username;
        $this->email = $email;
        $this->id = $id;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'id' => $this->id
        ];
    }
}
