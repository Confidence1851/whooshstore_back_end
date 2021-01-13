<?php


namespace App\Transformers;

use App\Models\Country;
use App\Models\ProductImage;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductImageTransformer
{
    public function transform(ProductImage $model)
    {
        return [
            "image" => $model->getImage()
        ];
    }

    public function collect($collection)
    {
        $transformer = new ProductImageTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }

    


}
