<?php

namespace App\Services;

use App\Http\Resources\WalletResource;
use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;

class WalletService
{
    private WalletRepository $walletRepository;

    public function __construct(WalletRepositoryInterface $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    // public function store(array $data): WalletResorce
    // {
    //     $data["password"] = bcrypt($data["password"]);
    //     return new UserResorce($this->userRepository->store($data));
    // }

    public function show(string $userId): WalletResource
    {
        return new WalletResource($this->walletRepository->show($userId));
    }

    public function showAll(): WalletResource
    {
        return new WalletResource($this->walletRepository->showAll());
    }

    public function update(Request $request)
    {

    }
}
