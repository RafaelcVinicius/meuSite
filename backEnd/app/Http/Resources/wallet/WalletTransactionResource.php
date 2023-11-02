<?php

namespace App\Http\Resources\wallet;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "operation" =>      $this->operation,
            "amount" =>         (float)$this->amount,
            "unitPrice" =>      (float)$this->unit_price,
            "acquisition" =>    Carbon::parse($this->acquisition_at)->format('Y-m-d'),
            "currentValue" =>   $this->when(isset($this->currentValue), $this->currentValue, null),
        ];
    }
}
