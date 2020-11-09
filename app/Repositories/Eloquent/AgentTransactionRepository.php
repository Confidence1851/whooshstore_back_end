<?php

namespace App\Repositories\Eloquent;
use App\Models\AgentTransaction;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\AgentTransactionRepositoryInterface;

class AgentTransactionRepository extends BaseRepository implements AgentTransactionRepositoryInterface
{

    public function __construct(AgentTransaction $model)
    {
        parent::__construct($model);
    }
}
