<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CorporateBondsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" =>                 $this->id,
            "bonds" =>              $this->bonds,
            "payment_type" =>       $this->payment_type,
            "variavel_rate_type" => $this->variavel_rate_type,
            "variavel_rate" =>      $this->variavel_rate,
            "flat_rate" =>          $this->flat_rate,
        ];
    }
}
