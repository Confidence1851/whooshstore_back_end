<?php

namespace App\Repositories\Eloquent;
use App\Models\Chat;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ChatRepositoryInterface;

class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{
    public function __construct(Chat $model)
    {
        parent::__construct($model);
    }
}
