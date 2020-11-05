<?php

namespace App\Repositories\Eloquent;
use App\Models\Deposit;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\DepositRepositoryInterface;

class DepositRepository extends BaseRepository implements DepositRepositoryInterface
{
    public function __construct(Deposit $model)
    {
        parent::__construct($model);
    }

}
