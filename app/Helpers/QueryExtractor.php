<?php

namespace App\Helpers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class QueryExtractor
{

    public static function productQuery(Request $request)
    {
        $builder = Product::where("status", ApiConstants::ACTIVE_STATUS)
            ->whereHas("owner");

        if (!empty($key = strtolower($request["sort_order"]))) {
            if (in_array($key, ["asc", "desc"])) {
                $builder = $builder->orderBy("updated_at", $key);
            } else {
                $builder = $builder->inRandomOrder();
            }
        }
        if (!empty($key = $request["search_keywords"])) {
            $words = explode(' ', $key);
            $builder = $builder->whereIn("product_name", $words)->orWhere("product_name", "like", "%$key%");
        }
        if (!empty($key = $request["category_id"])) {
            $builder = $builder->where("category_id", $key);
        }

        if (!empty($key = strtolower($request["display_type"]))) {
            if($key == "today_deals"){
                $builder = $builder->where("today_deal", ApiConstants::ACTIVE_STATUS);
            }
            elseif($key == "new_arrivals"){
                $builder = $builder->orderBy("created_at", "desc");
            }
            elseif($key == "best_seller"){
                $builder = $builder->orderBy("sales_count", "desc");
            }
        }

        return $builder;
    }

    public static function orderHistoryQuery(Request $request)
    {
        $builder = Order::where("user_id" , auth("api")->id())
                    ->orderBy("id", "desc");

        
        if (!empty($key = $request["search_keywords"])) {
            $words = explode(' ', $key);
            $builder = $builder->whereIn("product_name", $words)->orWhere("product_name", "like", "%$key%");
        }

        if (!empty($key = $request["fromDate"])) {
            $builder = $builder->where("created_at", '>=' , carbon()->parse($key)->startOfDay());
        }

        if (!empty($key = $request["toDate"])) {
            $builder = $builder->where("created_at", '<=' , carbon()->parse($key)->endOfDay());
        }
        
        return $builder;
    }
}
