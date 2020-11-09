<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactUs;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;

class ContactUsRepository extends BaseRepository implements ContactUsRepositoryInterface
{
    public function __construct(ContactUs $model)
    {
        parent::__construct($model);
    }

}
