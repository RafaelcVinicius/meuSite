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
            "description" =>        $this->description,
            "originId" =>           $this->origin_id,
            "coins" =>              new CoinsWalletResource($this->coins),
            "corporateBonds" =>     new CorporateBondsResource($this->corporateBonds),
            "stockExchange" =>      new StockExchangeResource($this->stockExchange),
            "transaction" =>        WalletTransactionResource::collection($this->transaction),
        ];
    }
}
