<?php

namespace App\Repositories\Eloquent;
use App\Models\ChatMessage;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ChatmessageRepositoryInterface;

class ChatMessageRepository extends BaseRepository implements ChatmessageRepositoryInterface
{

    public function __construct(ChatMessage $model)
    {
        parent::__construct($model);
    }
}
