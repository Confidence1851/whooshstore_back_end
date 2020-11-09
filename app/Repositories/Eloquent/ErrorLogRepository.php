<?php

namespace App\Repositories\Eloquent;
use App\Models\ErrorLog;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ErrorLogRepositoryInterface;

class ErrorLogRepository extends BaseRepository implements ErrorLogRepositoryInterface
{

    public function __construct(ErrorLog $model)
    {
        parent::__construct($model);
    }
}
