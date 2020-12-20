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
            'price' => format_int($cart->price , 2),
            'discount' => format_int($cart->discount , 2),
            'total' => format_int($cart->total , 2),
            'items' => (int) $cart->items,
            'reference' => $cart->reference,
            'cartItems' => $cartItemTransformer->collect($cart->cartItems ?? [])
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
