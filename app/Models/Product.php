<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function productCategories(){

        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function owner(){
        return $this->belongsTo(User::class , 'user_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
