<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $table = 'wallet';

    protected $fillable = [
        "id",
    ];

    public function CoinsWallet(){
        return $this->hasOne(CoinsWallet::class, 'wallet_id', 'id');
    }

    public function WalletTransaction(){
        return $this->hasOne(WalletTransaction::class, 'wallet_id', 'id');
    }

    public function StockExchange(){
        return $this->hasOne(StockExchange::class, 'wallet_id', 'id');
    }

    public function CorporateBonds(){
        return $this->hasOne(CorporateBonds::class, 'wallet_id', 'id');
    }
}
