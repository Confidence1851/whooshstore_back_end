<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Payment;

/**
 * Class PaymentTransformer.
 *
 * @package namespace App\Transformers;
 */
class PaymentTransformer extends TransformerAbstract
{
    /**
     * Transform the Payment entity.
     *
     * @param \App\Models\Payment $model
     *
     * @return array
     */
    public function transform(Payment $model)
    {
        return [
            'id' => (int) $model->id,
            "payer_email" => $model->payer_email,
            "reference" => $model->reference,
            "currency" => $model->currency,
            "method" => $model->method,
            "amount" => $model->amount,
            "fees" => $model->fees,
            "receipt" => $model->receipt,
            "status" => $model->status,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
