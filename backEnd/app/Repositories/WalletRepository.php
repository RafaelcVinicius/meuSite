<?php

namespace App\Repositories;

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

    public function __construct(BcbSgsRepository $bcbSgsRepository)
    {
        $this->user =  User::findOrFail(Auth::user()->id);
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
        $dataWallet = [];
        $dataWallet['currentValue'] =   0;
        $dataWallet['investedAmount'] = 0;
        $dataWallet['performance'] =    0;
        $wallet =                       $this->user->wallet;

        foreach($wallet as $w){
            if(isset($w->corporateBonds)){
                foreach ($w->transaction as $value){
                    $dataWallet['investedAmount'] += $value->unit_price * $value->amount;
                    $reward =       new Carbon($w->corporateBonds->reward_at);
                    $acquisition =  new Carbon($value->acquisition_at);
                    $format =       '&dataInicial={'. $acquisition->format('d/m/Y') .'}&'.'dataFinal={'. $reward->format('d/m/Y') .'}';
                    $dataWallet['currentValue'] += $this->interestCalculation($this->bcbSgsRepository->showApiBcbSgs($w->corporateBonds->variavel_rate_type, $format), $value->unit_price * $value->amount, $w->corporateBonds->variavel_rate, $w->corporateBonds->flat_rate);
                }
            }
        }
        $dataWallet['performance'] =  $dataWallet['currentValue'] - $dataWallet['investedAmount'];
        return  $dataWallet;
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
        return $amountWithRate;
    }
}
