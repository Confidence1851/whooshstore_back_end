<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\RecentlyViewedProducts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function recentlyViewed(Request $request){
        $data = RecentlyViewedProducts::order
    }

    public function categories(Request $request){
        $data = 
    }

    public function sliderAndImages(Request $request){
        
    }

    public function trending(Request $request){
        
    }

    public function dealOfDay(Request $request){
        
    }
}
