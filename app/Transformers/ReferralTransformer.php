<?php


namespace App\Transformers;

use App\Models\Referral;

class ReferralTransformer
{
    public function transform(Referral $referral)
    {
         return [
             'id' => $referral->id,
             'name' => $referral->user->name ?? '',
             'created_at' => $referral->created_at
            ];
    }

    public function collect($collection)
    {
        $transformer = new ReferralTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

}
