<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
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
            "userUuid" =>           $this->user_uuid,
            "description" =>        $this->origin_id,
            "acquisition" =>        $this->acquisition_at,
            "coinsWallet" =>        new CoinsWalletResource($this->CoinsWallet),
            "CorporateBonds" =>     new CorporateBondsResource($this->CorporateBonds),
            "StockExchange" =>      new StockExchangeResource($this->StockExchange),
            "WalletTransaction" =>  new WalletTransactionResource($this->WalletTransaction),
        ];
    }
}
