<?php


namespace App\Transformers;

use App\Models\Product;

class ProductTransformer
{
    private $fullDetails;
    private $withCategory;
    public function __construct($fullDetails = false , $withCategory = true)
    {
        $this->fullDetails = $fullDetails;
        $this->withCategory = $withCategory;
    }
    public function transform(Product $product)
    {
        $categoryTrans = new ProductCategoryTransformer;
        $imagesTrans = new ProductImageTransformer;
        $shortDetails = [
            'id' => $product->id,
            'category' => $this->withCategory ? $categoryTrans->transform($product->category) : null,
            'name' => $product->product_name,
            'type' => $product->type,
            'price' => $product->price,
            'discount' => $product->percent_off,
            'payable_price' => ($product->price  - (($product->price * $product->percent_off) / 100)),
            'rating' => $product->star_rating,
            'display_image' => $product->getDefaultImage()
        ];

        if ($this->fullDetails) {
            $more = [
                'images' => $imagesTrans->collect($product->images),
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
        $transformer = new ProductTransformer($this->fullDetails );
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
}
