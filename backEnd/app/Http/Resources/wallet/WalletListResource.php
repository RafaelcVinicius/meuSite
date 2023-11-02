<?php

namespace App\Http\Resources\wallet;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            [
                "percentage" => 100,
                "amount" => 5,
                "name" => "Renda fixa",
                "itens" => $this->when($this->whereNotNull('corporateBonds'), function () {
                    $obj = [];
                    foreach ($this->whereNotNull('corporateBonds') as $value) {
                        $obj[] = [
                            "id"=> $value->id,
                            "description" => $value->description,
                            "value" => $value->transaction->sum('currentValue'),
                        ];
                    }
                    return $obj;
                }),
            ],
            [
                "percentage" => 0,
                "amount" => 5,
                "name" => "Ações",
                "itens" => WalletResource::collection($this->whereNotNull('stockExchange')),
            ],
            [
                "percentage" => 0,
                "amount" => 5,
                "name" => "Moedas",
                "itens" => WalletResource::collection($this->whereNotNull('coins')),
            ]
        ];
    }
}
