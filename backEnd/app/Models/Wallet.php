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
        'id',
        'description',
        'origin_id',
    ];

    public function coins(){
        return $this->hasOne(CoinsWallet::class, 'wallet_id', 'id');
    }

    public function transaction(){
        return $this->hasMany(WalletTransaction::class, 'wallet_id', 'id');
    }

    public function stockExchange(){
        return $this->hasOne(StockExchange::class, 'wallet_id', 'id');
    }

    public function corporateBonds(){
        return $this->hasOne(CorporateBonds::class, 'wallet_id', 'id');
    }

    public function user(){
        return $this->hasOne(User::class, 'uuid', 'user_uuid');
    }
}
