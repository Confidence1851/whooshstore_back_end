<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\RecentlyViewedProduct;

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
     * @param \App\Models\RecentlyViewedProduct $model
     *
     * @return array
     */
    public function transform(RecentlyViewedProduct $model)
    {
        $prouctTrans = new ProductTransformer;

        return [
            'id' => (int) $model->id,
            'session_key' => $model->session_key,
            'user' => $model->user,
            'product' => $prouctTrans->transform($model->product),
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
