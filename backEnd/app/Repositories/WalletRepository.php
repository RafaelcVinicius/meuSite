<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Wallet;
use App\Repositories\Contracts\WalletRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletRepository implements WalletRepositoryInterface
{
    private User $user;

    public function __construct()
    {
        $this->user =  User::findOrFail(Auth::user()->id);
    }

    public function store(array $data): Wallet
    {
        $Wallet = $this->user->wallet()->create($data['wallet']);

        if(array_key_exists('stockExchange', $data))
            $Wallet->stockExchange()->create($data['stockExchange']);

        if(array_key_exists('coins', $data))
            $Wallet->coins()->create($data['coins']);

        if(array_key_exists('corporateBonds', $data))
            $Wallet->corporateBonds()->create($data['corporateBonds']);

        $Wallet->transaction()->createMany($data['transaction']);

        return $Wallet->refresh();
    }

    public function show(string $walletId): Wallet
    {
        return $this->user->wallet->where('id', $walletId)->firstOrFail();
    }

    public function showAll(): object
    {
        return $this->user->wallet;
    }

    public function update(string $walletId, Request $request): Wallet
    {
        return Wallet::first();
    }
}
