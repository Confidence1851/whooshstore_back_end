<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ProductCategory;

/**
 * Class ProductCategoryTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProductCategoryTransformer extends TransformerAbstract
{

    private $withSubCategories;
    public function __construct($withSubCategories = false)
    {
        $this->withSubCategories = $withSubCategories;
    }

    /**
     * Transform the ProductCategory entity.
     *
     * @param \App\Models\ProductCategory $model
     *
     * @return array
     */
    public function transform(ProductCategory $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'icon' => $model->icon,
            'image' => $model->image,
            'sub_categories' => $this->withSubCategories ? $this->collect($model->sub_categories) : [],
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function transformWIthId($id){
        $category = ProductCategory::find($id) ?? new ProductCategory;
        return $this->transform($category);
    }


    public function collect($collection)
    {
        $transformer = new ProductCategoryTransformer();
        return collect($collection)->map(function ($model) use ($transformer) {
            return $transformer->transform($model);
        });
    }
}
