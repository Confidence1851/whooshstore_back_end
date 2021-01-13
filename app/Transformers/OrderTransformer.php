<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Order;

/**
 * Class OrderTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{

    private $fullDetails;
    public function __construct($fullDetails = false)
    {
        $this->fullDetails = $fullDetails;
    }

    /**
     * Transform the Order entity.
     *
     * @param \App\Models\Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        $userTrans = new UserTransformer;
        $paymentTrans = new PaymentTransformer;
        $orderItemTrans = new OrderItemTransformer;
        $shortDetails = [
            'id'         => (int) $model->id,
            'user' => $userTrans->transform($model->user),
            'reference' => $model->reference,
            'amount' => format_money($model->amount),
            'discount' => format_money($model->discount),
            'payment_type' => $model->payment_type,
            'comment' => $model->comment,
            'status' => $model->status,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];

        if($this->fullDetails){
            $payment = $model->payment;
            $more = [
                "payment" => $paymentTrans->transform($payment),
                "order_items" => $orderItemTrans->collect($model->items)
            ];
        }
        else{
            $more = [];
        }
        
        return array_merge($shortDetails, $more);
    }
}
