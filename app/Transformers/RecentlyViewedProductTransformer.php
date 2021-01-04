<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\RecentlyViewedProduct;

/**
 * Class RecentlyViewedProductTransformer.
 *
 * @package namespace App\Transformers;
 */
class RecentlyViewedProductTransformer extends TransformerAbstract
{
    /**
     * Transform the RecentlyViewedProduct entity.
     *
     * @param \App\Entities\RecentlyViewedProduct $model
     *
     * @return array
     */
    public function transform(RecentlyViewedProduct $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
