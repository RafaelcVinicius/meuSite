<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    private WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    // public function store(Request $request){
    //     return $this->walletService->store($request->all());
    // }

    public function show(Request $request, $id){
        return $this->walletService->show($id);
    }

    public function showAll(Request $request){
        return $this->walletService->showAll();
    }
}
