<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\OrderItem;

/**
 * Class OrderItemTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{
    /**
     * Transform the OrderItem entity.
     *
     * @param \App\Models\OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model)
    {
        $prodTrans = new ProductTransformer();
        $userTrans = new UserTransformer();
        $orderTrans = new OrderTransformer();

        return [
            "id" => $model->id,
            "user" => $userTrans->transform($model->order->user),
            "product" => $prodTrans->transform($model->product),
            "order" => $orderTrans->transform($model->order),
            "amount" => format_money($model->amount , 0 ),
            "discount" => $model->discount,
            "quantity" => $model->quantity,
            "extra" => $model->extra,
            "status" => $model->status,
            "created_at" => $model->created_at,
            "updated_at" => $model->updated_at,
        ];
    }

    public function collect($collection)
    {
        return collect($collection)->map(function ($model) {
            return $this->transform($model);
        });
    }
}
