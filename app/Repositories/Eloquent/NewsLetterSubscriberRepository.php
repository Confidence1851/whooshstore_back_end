<?php

namespace App\Repositories\Eloquent;
use App\Models\NewsLetterSubscriber;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\NewsLetterSubscriberRepositoryInterface;

class NewsLetterSubscriberRepository extends BaseRepository implements NewsLetterSubscriberRepositoryInterface
{

    public function __construct(NewsLetterSubscriber $model)
    {
        parent::__construct($model);
    }
}
