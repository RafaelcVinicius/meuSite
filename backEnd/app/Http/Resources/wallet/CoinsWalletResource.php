<?php

namespace App\Http\Resources\wallet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoinsWalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "symbol" =>     $this->symbol,
        ];
    }
}
