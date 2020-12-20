<?php


namespace App\Transformers;

use App\Models\Product;

class ProductTransformer
{
    private $fullDetails;
    public function __construct($fullDetails = false)
    {
        $this->fullDetails = $fullDetails;
    }
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'discount' => $product->discount,
            'sku' => $product->sku,
            'price' => $product->price,
            'video' => $product->video,
            'description' => $product->description,
            'details' => $product->details,
            'tags' => $product->tags,
            'weight' => $product->weight,
            'color' => $product->color,
            'size' => $product->size,
            'type' => $product->type,
            'status' => $product->status,
        ];
    }

    public function collect($collection)
    {
        $transformer = new ProductTransformer($this->fullDetails);
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

}
