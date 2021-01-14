<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $categories = array("Health & Beauty", "Home & Office", "Phones & Tablets","Computing","Electronics","Fashion","Baby Products","Gaming","Sporting Goods");
        
        $category = array();
        foreach ($categories as $value) {
            $cat = array(
                "name" => $value,
                "icon" => 'star',
                "slug" => $value,
                'image' => 'public/uploads/product-category',
            );
            array_push($category,$cat);
        }
        foreach ($category as $key => $value) {
            ProductCategory::create($value);
        }
    }
}
