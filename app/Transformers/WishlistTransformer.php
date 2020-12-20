<?php


namespace App\Transformers;

use App\Models\Product;
use App\Models\Wishlist;

class WishlistTransformer
{
    public function transform(Wishlist $wishlist)
    {
        $productTransformer = new ProductTransformer(false);
        return $productTransformer->transform($wishlist->product ?? new Product());
    }

    public function collect($collection)
    {
        $transformer = new WishlistTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
    

}
