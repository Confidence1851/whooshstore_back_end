<?php

namespace App\Transformers;

use App\Helpers\QueryExtractor;
use App\Models\Product;
use League\Fractal\TransformerAbstract;
use App\Models\ProductSearch;

/**
 * Class ProductSearchTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductSearchTransformer extends TransformerAbstract
{
    /**
     * Transform the ProductSearch entity.
     *
     * @param \App\Models\ProductSearch $model
     *
     * @return array
     */
    public function transform(ProductSearch $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function prepare($searches)
    {
        $productsList = collect();
        foreach($searches as $search){
            $query = unserialize($search->query);
            $request = request()->merge($query);
            $data = QueryExtractor::productQuery($request)->get();
            $productsList = $productsList->merge($data);
        }

        $products = collect($productsList->unique('id')->values());


        $category_ids = $products->pluck("category_id");
        $catTransformer = new ProductCategoryTransformer;
        $prodTransformer = new ProductTransformer;

        $data = collect();

        foreach($category_ids as $id){
            $catProds = collect();
            foreach($products as $prod){
                if($prod["category_id"] == $id){
                    $catProds->push($prod);
                }
            }

            $item["category"] = $catTransformer->transformWIthId($id);
            $item["products"] = $prodTransformer->collect($catProds);
            $data->push($item);
        }

        return $data;
    }
}
