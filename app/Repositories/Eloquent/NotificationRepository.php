<?php

namespace App\Repositories\Eloquent;
use App\Models\Notification;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\NotificationRepositoryInterface;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{

    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }
}
