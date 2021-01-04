<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BillingAddress;

/**
 * Class BillingAddressTransformer.
 *
 * @package namespace App\Transformers;
 */
class BillingAddressTransformer extends TransformerAbstract
{
    /**
     * Transform the BillingAddress entity.
     *
     * @param \App\Entities\BillingAddress $model
     *
     * @return array
     */
    public function transform(BillingAddress $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
