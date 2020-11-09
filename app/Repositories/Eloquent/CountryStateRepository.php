<?php

namespace App\Repositories\Eloquent;
use App\Models\CountryState;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\CountryStateRepositoryInterface;

class CountryStateRepository extends BaseRepository implements CountryStateRepositoryInterface
{
    public function __construct(CountryState $model)
    {
        parent::__construct($model);
    }
}
