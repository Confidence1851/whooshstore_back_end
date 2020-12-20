<?php


namespace App\Transformers;

use App\Models\Cart;

class CartTransformer
{
    public function transform(Cart $cart)
    {
        $cartItemTransformer = new CartItemTransformer;
        return [
            'id' => $cart->id,
            'price' => $cart->price,
            'discount' => $cart->discount,
            'total' => $cart->total,
            'quantity' => $cart->quantity,
            'reference' => $cart->reference,
            'items' => $cartItemTransformer->collect($cart->cartItems ?? [])
        ];
    }

    public function collect($collection)
    {
        $transformer = new CartTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
    

}
