<?php

namespace App\Repositories\Eloquent;
use App\Models\Investment;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\InvestmentRepositoryInterface;

class InvestmentRepository extends BaseRepository implements InvestmentRepositoryInterface
{

    public function __construct(Investment $model)
    {
        parent::__construct($model);
    }
}
