<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\models\Product;
class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = request();
        $product = Product::find($request["product"]);
        if(!empty($product)){
            $name_rule = "required|string";
        }
        else{
            $name_rule = 'required|unique:products';
        }
        return [
            'product_name' => $name_rule,
            'slug' => 'required',
            'category_id' => 'required',
            'sku' => 'nullable',
            'quantity' => 'required',
            'price' => 'required',
            'video' => 'nullable',
            'description' => 'required',
            'details' => 'nullable',
            'tags' => 'nullable',
            'percent_off' => 'nullable',
            'weight' => 'nullable',
            'color' => 'nullable',
            'size' => 'nullable',
            'type' => 'required',
            'status' => 'required',
        ];
    }
}
