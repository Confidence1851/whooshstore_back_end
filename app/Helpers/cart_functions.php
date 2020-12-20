<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

/** Returns cart details
     * @return object
     */
    function getUserCart($guard = "api"){
        // if(session()->has('my_cart')){
        //     $cart = session()->get('my_cart');
        // }
        // else{
        $user = auth($guard)->user();

        $cart = Cart::where('user_id', $user->id)->first();
        if(empty($cart)){
            $cart = Cart::create([
                'user_id' => $user->id,
                'price' => 0,
                'discount' => 0,
                'total' => 0,
                'items' => 0,
                'reference' => generateCartHash(),
            ]);
        }
        // }

        return $cart;
    }


    /** Refreshes cart details based on cart  items
     * @param int cart_id
     * @param bool generate_reference
     * @return cart object
     */
    function refreshCart($cart_id , $generate_reference = false){
        $cart = Cart::find($cart_id);
        $items = CartItem::where('cart_id' , $cart->id)->get();
        $price = 0;
        $discount = 0;
        $total = 0;
        $count = 0;
        foreach($items as $item){
            $count++;
            if(!empty($item->dish_id)){
                $price_= ($item->price * $item->quantity);
                $disc_ = ($item->discount * $item->quantity);
                $price += $price_;
                $discount += $disc_;
                $total += ($price_ - $disc_);
            }
        }

        $cart->price = $price;
        $cart->discount = $discount;
        $cart->total = $total;
        $cart->items = $count;

        if($generate_reference){
            $cart->reference = generateCartHash();
        }
        $cart->save();

        // session()->forget('my_cart');
        // session()->put('my_cart' ,$cart );

        return $cart;
    }

    function generateCartHash(){
        $token = getRandomToken(10);
        $check = Cart::where('reference',$token)->count();
        if($check == 0){
            return strtoupper($token);
        }
        return generateCartHash();
    }


    /** Checks if a course is in cart and returns item if found
     */
    function cartHasItem($dish_id){
        // return CartItem::where('cart_id', getUserCart()->id)->where('dish_id' , $dish_id)->first();
    }


    function cartHasPlan($plan_id){
        // return CartItem::where('cart_id', getUserCart()->id)->where('plan_id' , $plan_id)->first();
    }

    function userOrderedProduct($user_id){
        $user = User::find($user_id);
        return  Product::where('user_id' , $user->id)->whereHas('course')->whereHas('order' , function ($query) {
            $query->where('status' , 1);
        })->pluck('course_id');
    }


    // function getMyProducts($guard = "api"){
    //     $my_products = [];
    //     if(auth($guard)->check()){
    //         if(session()->has('my_products')){
    //             $my_products = session()->get('my_products');
    //         }
    //         else{
    //             $my_products = userOrderedProduct(auth($guard)->id());
    //             session()->put('my_products',$my_products);
    //         }
    //     }
    //     return $my_products;
    // }
