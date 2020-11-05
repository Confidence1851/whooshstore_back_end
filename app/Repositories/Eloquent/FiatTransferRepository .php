<?php

namespace App\Repositories\Eloquent;
use App\Models\FiatTransfer;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\FiatTransferRepositoryInterface;

class FiatTransferRepository extends BaseRepository implements FiatTransferRepositoryInterface
{
    public function __construct(FiatTransfer $model)
    {
        parent::__construct($model);
    }

}
