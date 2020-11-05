<?php

namespace App\Repositories\Eloquent;
use App\Models\Referral;
use App\Repositories\Interfaces\ReferralRepositoryInterface;

class ReferralRepository extends BaseRepository  implements ReferralRepositoryInterface
{

    /**
     * Repository constructor
     *
     */
    public function __construct(Referral $model)
    {
        parent::__construct($model);
    }
}
