<?php

namespace App\Repositories\Eloquent;
use App\Models\Withdrawal;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\WithdrawalRepositoryInterface;

class WithdrawalRepository extends BaseRepository implements WithdrawalRepositoryInterface
{
    public function __construct(Withdrawal $model)
    {
        parent::__construct($model);
    }
}
