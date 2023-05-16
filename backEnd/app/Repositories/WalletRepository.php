<?php

namespace App\Repositories;

use App\Http\Resources\WalletResource;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\Contracts\BcbSgsRepositoryInterface;
use App\Repositories\Contracts\WalletRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletRepository implements WalletRepositoryInterface
{
    private User $user;
    protected BcbSgsRepository $bcbSgsRepository;

    public function __construct(BcbSgsRepositoryInterface $bcbSgsRepository)
    {
        $this->user =  User::findOrFail(1);
        $this->bcbSgsRepository = $bcbSgsRepository;
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

    public function showAll()
    {
        $wallet = $this->user->wallet;

        foreach($wallet as $w){
            if(!empty($w['corporateBonds'])){
                foreach ($w->transaction as $value){
                    $reward =       new Carbon($w->corporateBonds->reward_at);
                    $acquisition =  new Carbon($value->acquisition_at);
                    $format =       '&dataInicial={'. $acquisition->add(1,'day')->format('d/m/Y') .'}&'.'dataFinal={'. $reward->format('d/m/Y') .'}';
                    $value['currentValue'] = $this->interestCalculation($this->bcbSgsRepository->showApiBcbSgs($w->corporateBonds->variavel_rate_type, $format), $value->unit_price * $value->amount, $w->corporateBonds->variavel_rate, $w->corporateBonds->flat_rate);
                }
            }
        }

        return  $wallet;
    }

    public function update(string $walletId, Request $request): Wallet
    {
        return Wallet::first();
    }

    private function interestCalculation(array $dataRate, $amount, $variavelRate, $flatRate = 0){
        $amountWithRate = $amount;
        if($flatRate > 0)
            $flatRate = $flatRate / 12;

        foreach ($dataRate as $value) {
            $amountWithRate += $amountWithRate * (((($value->valor * $variavelRate)/100 + $flatRate )/100) );
        }
        return round($amountWithRate, 2, PHP_ROUND_HALF_EVEN);
    }
}
