<?php

namespace App\Repositories\Eloquent;
use App\Models\Transaction;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{

    /**
     * Repository constructor
     *
     */
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

}
