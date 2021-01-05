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
        $categoryTrans = new ProductCategoryTransformer;
        $imagesTrans = new ProductImageTransformer;
        $shortDetails = [
            'id' => $product->id,
            'category' => $categoryTrans->transform($product->category),
            'name' => $product->product_name,
            'type' => $product->type,
            'price' => $product->price,
            'discount' => $product->percent_off,
            'payable_price' => ($product->price  - (($product->price * $product->percent_off) / 100)),
            'display_image' => $product->getDefaultImage()
        ];

        if ($this->fullDetails) {
            $more = [
                'images' => $imagesTrans->collect($product->images()),
                'video' => $product->video,
                'description' => $product->description,
                'details' => $product->details,
                'tags' => $product->tags,
                'weight' => $product->weight,
                'color' => $product->color,
                'size' => $product->size,
                'sku' => $product->sku,
                'type' => $product->type,
                'status' => $product->status,
            ];
        } else {
            $more = [];
        }
        return array_merge($shortDetails, $more);
    }

    public function collect($collection)
    {
        $transformer = new ProductTransformer($this->fullDetails);
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
}
