<?php

namespace App\Services;

use App\Http\Resources\WalletResource;
use App\Repositories\Contracts\WalletRepositoryInterface;
use App\Repositories\WalletRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletService
{
    private WalletRepository $walletRepository;

    public function __construct(WalletRepositoryInterface $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    public function store(array $data): WalletResource
    {
        // $data['user_uuid'] = Auth::user()->uuid;
        return new WalletResource($this->walletRepository->store($this->prepareToStore($data)));
    }

    public function show(string $userId): WalletResource
    {
        return new WalletResource($this->walletRepository->show($userId));
    }

    public function showAll(): object
    {
        return WalletResource::collection($this->walletRepository->showAll());
    }

    public function update(Request $request)
    {

    }
    private function prepareToStore(array $data): array
    {
        $newData = [
            'wallet' => [
                'description' =>    $data['description'],
                'acquisition_at' => $data['acquisition'],
                'origin_id' =>      $data['originId'],
            ]
        ];

        if(array_key_exists('stockExchange', $data))
            $newData['stockExchange'] = $data['stockExchange'];

        if(array_key_exists('coins', $data))
            $newData['coins'] = $data['coins'];

        if(array_key_exists('corporateBonds', $data)){
            $newData['corporateBonds']['description'] =         $data['corporateBonds']['description'];
            $newData['corporateBonds']['payment_type'] =        $data['corporateBonds']['paymentType'];
            if($data['corporateBonds']['paymentType'] == 1){
                $newData['corporateBonds']['variavel_rate_type'] =  $data['corporateBonds']['variavelRateType'];
                $newData['corporateBonds']['variavel_rate'] =       $data['corporateBonds']['variavelRate'];
            }else{
                $newData['corporateBonds']['flat_rate'] =           $data['corporateBonds']['flatRate'];
            }
        }

        foreach($data['transaction'] as $key => $transaction){
            $newData['transaction'][$key]['operation'] =  $transaction['operation'];
            $newData['transaction'][$key]['amount'] =     $transaction['amount'];
            $newData['transaction'][$key]['unit_price'] =  $transaction['unitPrice'];
        }

        return  $newData;
    }
}
