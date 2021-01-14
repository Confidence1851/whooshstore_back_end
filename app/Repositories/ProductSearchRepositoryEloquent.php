<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductSearchRepository;
use App\Models\ProductSearch;
use App\Validators\ProductSearchValidator;

/**
 * Class ProductSearchRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductSearchRepositoryEloquent extends BaseRepository implements ProductSearchRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductSearch::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProductSearchValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
