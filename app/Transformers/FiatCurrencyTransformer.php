<?php


namespace App\Transformers;


use App\Models\Currency;

class FiatCurrencyTransformer
{
    public function transform(Currency $currency)
    {

         return [
             'id' => $currency->id,
             'symbol' => $currency->symbol,
             'name' => $currency->name,
             'short_name' => $currency->short_name,
             'rate' => $currency->rate,
             'country' => $currency->country->name,
         ];
    }

    public function collect($collection)
    {
        $transformer = new FiatCurrencyTransformer ();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

}
