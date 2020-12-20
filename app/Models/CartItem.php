<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $guarded = [];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class , 'plan_id');
    }
}
