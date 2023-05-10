<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Contracts\WalletRepositoryInterface;
use Illuminate\Http\Request;

class WalletRepository implements WalletRepositoryInterface
{
    public function store(array $data): Wallet
    {
        return Wallet::FindOrFail();
    }

    public function show(string $walletId): Wallet
    {
        return Wallet::FindOrFail($walletId);
    }

    public function showAll(): object
    {
        return Wallet::first();
    }

    public function update(string $walletId, Request $request): Wallet
    {
        return Wallet::first();
    }
}
