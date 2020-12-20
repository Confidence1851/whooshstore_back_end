<?php


namespace App\Transformers;

use App\Models\CartItem;

class CartItemTransformer
{
    public function transform(CartItem $cartItem)
    {
        return [
            'id' => $cartItem->id,
            'cart_id' => $cartItem->cart_id,
            'product' => $cartItem->product,
        ];
    }

    public function collect($collection)
    {
        $transformer = new CartItemTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
}
