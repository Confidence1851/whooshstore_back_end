<?php


namespace App\Transformers;

use App\Models\Country;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryTransformer
{
    public function transform(Country $country)
    {
        $path = 'images/country_flags/';
        $flag = my_asset($path.'flag-of-'.slugifyReplace($country->name).'.jpg');
         return [
             'id' => $country->id,
             'flag' => $flag,
             'name' => $country->name,
             'phone_code' => $country->phonecode,
         ];
    }

    public function collect($collection)
    {
        $transformer = new CountryTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

    


}
