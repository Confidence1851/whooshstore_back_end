<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BillingAddressRepository;
use App\Models\BillingAddress;
use App\Validators\BillingAddressValidator;

/**
 * Class BillingAddressRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BillingAddressRepositoryEloquent extends BaseRepository implements BillingAddressRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillingAddress::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BillingAddressValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
