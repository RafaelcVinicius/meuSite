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
            'acquisition' =>                        ['date'],
            'originId' =>                           ['int'],

            'stockExchange.symbol' =>               ['required_with:stockExchange','string'],

            'coins.symbol' =>                       ['required_with:coins','string'],

            'corporateBonds.description' =>         ['required_with:corporateBonds','string'],
            'corporateBonds.paymentType' =>         ['required_with:corporateBonds','max:1'],
            'corporateBonds.variavelRateType' =>    ['exclude_unless:corporateBonds.paymentType,1','required','string'],
            'corporateBonds.variavelRate' =>        ['exclude_unless:corporateBonds.paymentType,1','required','numeric'],
            'corporateBonds.flatRate' =>            ['exclude_unless:corporateBonds.paymentType,0','required','numeric'],

            'transaction' =>                        ['array', 'required'],
            'transaction.*.operation' =>            ['required','max:1'],
            'transaction.*.amount' =>               ['required','int'],
            'transaction.*.unitPrice' =>            ['required','numeric'],
        ];
    }
}
