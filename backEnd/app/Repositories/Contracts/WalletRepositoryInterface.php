<?php

namespace App\Repositories\Contracts;

use App\Models\Wallet;
use Illuminate\Http\Request;

interface WalletRepositoryInterface
{
    public function store(array $data): Wallet;
    public function show(string $walletId): Wallet;
    public function showAll();
    public function update(string $walletId, Request $request): Wallet;
}
