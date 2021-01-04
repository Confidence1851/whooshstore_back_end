<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RecentlyViewedProductRepository;
use App\Models\RecentlyViewedProduct;
use App\Validators\RecentlyViewedProductValidator;

/**
 * Class RecentlyViewedProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RecentlyViewedProductRepositoryEloquent extends BaseRepository implements RecentlyViewedProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RecentlyViewedProduct::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RecentlyViewedProductValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
