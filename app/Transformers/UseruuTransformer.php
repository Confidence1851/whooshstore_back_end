<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Useruu;

/**
 * Class UseruuTransformer.
 *
 * @package namespace App\Transformers;
 */
class UseruuTransformer extends TransformerAbstract
{
    /**
     * Transform the Useruu entity.
     *
     * @param \App\Models\Useruu $model
     *
     * @return array
     */
    public function transform(Useruu $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
