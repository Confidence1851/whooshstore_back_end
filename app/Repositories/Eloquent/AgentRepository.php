<?php

namespace App\Repositories\Eloquent;
use App\Models\Agent;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\AgentRepositoryInterface;

class AgentRepository extends BaseRepository implements AgentRepositoryInterface
{
    public function __construct(Agent $model)
    {
        parent::__construct($model);
    }
}
