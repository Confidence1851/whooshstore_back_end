<?php

namespace App\Repositories\Eloquent;
use App\Models\AdminLog;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\AdminLogRepositoryInterface;

class AdminLogRepository extends BaseRepository implements AdminLogRepositoryInterface
{

    public function __construct(AdminLog $model)
    {
        parent::__construct($model);
    }
}
