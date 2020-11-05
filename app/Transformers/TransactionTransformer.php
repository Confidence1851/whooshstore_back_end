<?php


namespace App\Transformers;

use App\Models\Country;
use App\Models\Transaction;

class TransactionTransformer
{
    public function transform(Transaction $transaction , $withData = true)
    {
       if($withData){
        $data = $transaction->deposit ?? 
                $transaction->withdrawal ?? 
                $transaction->investment ?? 
                $transaction->crypto_transfer ?? 
                $transaction->fiat_transfer ?? null;
       }
        $data_id = $transaction->fiat_transfer_id ??
                $transaction->fiat_transfer_id ??
                $transaction->deposit_id ??
                $transaction->withdrawal_id ??
                $transaction->investment_id ??
                $transaction->crypto_transfer_id ?? null;

         return [
             'id' => $transaction->id,
             'narration' =>  $transaction->narration,
             'reference' => $transaction->reference,
             'type' => $transaction->type,
             'method' => $transaction->reference,
             'amount' => format_money($transaction->amount),
             'status' => $transaction->status == 0 ? 'Pending' : 'Complete',
             'data_id' => $data_id,
             'data' => $data ?? null,
         ];
    }

    public function collect($collection, $withData = true)
    {
        $transformer = new TransactionTransformer();
        return collect($collection)->map(function ($model) use ($transformer , $withData) {
            return $transformer->transform($model , $withData);
        });
    }

}
