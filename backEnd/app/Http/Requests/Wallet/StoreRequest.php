<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' =>                        ['required', 'min:3', 'max:255', 'string'],
            'originId' =>                           ['int'],

            'stockExchange.symbol' =>               ['required_with:stockExchange','string'],

            'coins.symbol' =>                       ['required_with:coins','string'],

            'corporateBonds.description' =>         ['required_with:corporateBonds','string'],
            'corporateBonds.variavelRateType' =>    ['int'],
            'corporateBonds.variavelRate' =>        ['numeric'],
            'corporateBonds.flatRate' =>            ['numeric'],
            'corporateBonds.reward' =>              ['required_with:corporateBonds','date'],

            'transaction' =>                        ['array', 'required'],
            'transaction.*.operation' =>            ['required','max:1'],
            'transaction.*.amount' =>               ['required','numeric'],
            'transaction.*.unitPrice' =>            ['required','numeric'],
            'transaction.*.acquisition' =>          ['date'],

        ];
    }
}
