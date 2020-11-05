<?php


namespace App\Transformers;

use App\Models\BankAccount;

class BankAccountTransformer
{
    public function transform(BankAccount $bankAccount , $withUser = false)
    {

        return [
            'id' => $bankAccount->id,
            'bank_name' => $bankAccount->bank_name,
            'account_name' => $bankAccount->account_name,
            'account_number' => $bankAccount->account_number,
        ];
    }

    public function collect($collection , $withUser = false)
    {
        $transformer = new BankAccountTransformer();
        return collect($collection)->map(function ($model) use ($transformer , $withUser) {
            return $transformer->transform($model , $withUser);
        });
    }

}
