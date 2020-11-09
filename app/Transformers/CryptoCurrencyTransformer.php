<?php


namespace App\Transformers;

use App\Models\CryptoCurrency;

class CryptoCurrencyTransformer
{
    public function transform(CryptoCurrency $currency)
    {

         return [
             'id' => $currency->id,
             'image' => $currency->image ?? 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.kindpng.com%2Fimgv%2FTJohmTT_trx-tron-hd-png-download%2F&psig=AOvVaw2DOfbTeXrnUD6wIbww8Etx&ust=1598834164120000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCLCRxszXwesCFQAAAAAdAAAAABAD',
             'name' => $currency->getPairs(),
             'pair_1' => $currency->pair_1,
             'pair_2' => $currency->pair_2,
             'rate' => $currency->rate,
             'fees' => $currency->fees,
             'fee_type' => $currency->fee_type,
             'payment_address' => $currency->payment_address ?? 'apaymentaddress_for_tron',
         ];
    }

    public function collect($collection)
    {
        $transformer = new CryptoCurrencyTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

}
