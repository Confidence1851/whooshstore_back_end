<?php

namespace App\Repositories\Eloquent;
use App\Models\VerificationPin;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\VerificationPinRepositoryInterface;

class VerificationPinRepository extends BaseRepository implements VerificationPinRepositoryInterface
{
    public function __construct(VerificationPin $model)
    {
        parent::__construct($model);
    }
}
