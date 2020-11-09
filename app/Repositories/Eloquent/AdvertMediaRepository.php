<?php

namespace App\Repositories\Eloquent;
use App\Models\AdvertMedia;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\AdvertMediaRepositoryInterface;

class AdvertmediaRepository extends BaseRepository implements AdvertMediaRepositoryInterface
{

    public function __construct(AdvertMedia $model)
    {
        parent::__construct($model);
    }
}
