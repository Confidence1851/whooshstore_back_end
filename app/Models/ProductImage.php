<?php

namespace App\Models;

use App\Traits\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory , Constants;

    public $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class , "product_id");
    }

    public function getImage($getPath = true){ //if true , return only path else return image url
        $relativePath = "$this->productImagePath/$this->image";
        if($getPath){
            return $relativePath;
        }
        return route("read_file" , encrypt($relativePath));
    }
}
