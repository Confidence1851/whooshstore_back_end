<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RecentlyViewedProductsRepository;
use App\Entities\RecentlyViewedProducts;
use App\Validators\RecentlyViewedProductsValidator;

/**
 * Class RecentlyViewedProductsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RecentlyViewedProductsRepositoryEloquent extends BaseRepository implements RecentlyViewedProductsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RecentlyViewedProducts::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
