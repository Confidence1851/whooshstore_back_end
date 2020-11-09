<?php

namespace App\Repositories\Eloquent;
use App\Models\Account;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\AccountRepositoryInterface;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }

}
