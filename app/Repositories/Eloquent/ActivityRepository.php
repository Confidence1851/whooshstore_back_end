<?php

namespace App\Repositories\Eloquent;
use App\Models\Activity;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ActivityRepositoryInterface;

class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface
{
    public function __construct(Activity $model)
    {
        parent::__construct($model);
    }
}
