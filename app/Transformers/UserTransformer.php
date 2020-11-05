<?php


namespace App\Transformers;

use App\Models\User;

class UserTransformer
{
    public function transform(User $user)
    {

        $countryTrans = new CountryTransformer();
        $stateTrans = new CountryStateTransformer();

        return [
            'is_complete' => true,
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
            'phone' => $user->phone,
            'country' => !empty($user->country) ? $countryTrans->transform($user->country) : null,
            'state' => !empty($user->state) ? $stateTrans->transform($user->state) : null,
            'account_no' => $user->account_no,
            'status' => $user->status,
        ];
    }

    public function collect($collection)
    {
        $transformer = new UserTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
    

}
