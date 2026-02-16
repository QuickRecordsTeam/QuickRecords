<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InitPaymentResource extends JsonResource
{
    private $reference;
    private $ussd_code;

    public function __construct($reference, $ussd_code)
    {
        parent::__construct(null);
        $this->reference = $reference;
        $this->ussd_code = $ussd_code;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reference' => $this->reference,
            'ussd_code' => $this->ussd_code,
        ];
    }
}
