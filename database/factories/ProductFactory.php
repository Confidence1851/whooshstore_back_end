<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = Str::slug($name);
        $type = ['new','featured'];
        $status = ['active','inactive'];
        return [
            'product_name' => $name,
            'slug' => $slug,
            'category_id' => Productcategory::factory(),
            'user_id' => 2,
            'sku' => '1',
            'quantity' => '10',
            'price' => 1499,
            'video' => 'file',
            'description' => 'A stock-keeping unit (SKU) is a scannable bar code, most often seen printed on product labels in a retail store',
            'details' => '30 inch price',
            'tags' => 'tv',
            'percent_off' => '10',
            'weight' => '4',
            'color' => 'yellow',
            'size' => 'xl',
            'type' => 'featured',
            'status' => 'active',
        ];
    }
}
