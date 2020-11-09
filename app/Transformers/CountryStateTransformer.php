<?php


namespace App\Transformers;

use App\Models\CountryState;

class CountryStateTransformer
{
    public function transform(CountryState $countryState , $withCountry = false)
    {
        $countryTrans = new CountryTransformer();
        // if($withCountry){

        // }
         return [
             'id' => $countryState->id,
             'name' => $countryState->name,
             'country' => $withCountry ? $countryTrans->transform($countryState->country) : null,
         ];
    }

    public function collect($collection , $withCountry = false)
    {
        $transformer = new CountryStateTransformer();
        return collect($collection)->map(function ($model) use ($transformer , $withCountry) {
            return $transformer->transform($model , $withCountry);
        });
    }

}
