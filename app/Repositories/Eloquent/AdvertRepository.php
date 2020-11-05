<?php

namespace App\Repositories\Eloquent;
use App\Models\Advert;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\AdvertRepositoryInterface;

class AdvertRepository extends BaseRepository implements AdvertRepositoryInterface
{

    public function __construct(Advert $model)
    {
        parent::__construct($model);
    }
}
