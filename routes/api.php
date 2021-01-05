<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('App\Http\Controllers\Api\v1')->prefix("v1")->group(function () {

    Route::namespace('Auth')->group(function () {
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login');

        Route::as('auth.')->prefix("auth")->middleware('auth:api')->group(function () {
            Route::get('validate-token', 'VerificationController@validate_token');
            Route::get('email/verify/{id}', 'VerificationController@verify_email')->name('api.verify_email');
            Route::get('email/resend', 'VerificationController@resend_email')->name('api.resend_email');
            Route::get('verification-pin', 'VerificationController@sendVerificationEmail');
            Route::post('verify-email-pin', 'VerificationController@confirmVerificationPin');
        });
    });

    Route::as('products.')->prefix("products")->group(function () {
        Route::get('list', 'ProductController@index');
        Route::get('detail', 'ProductController@show');
    });

    Route::as('home.')->prefix("home")->group(function () {
        Route::get('recently-viewed-products', 'HomeController@recentlyViewed');
        Route::get('product-categories', 'HomeController@productCategories');
        Route::get('trending-searches', 'HomeController@trendingSearches');
    });

    Route::as('auth.')->middleware('auth:api')->group(function () {
        Route::as('cart.')->prefix("cart")->middleware('auth:api')->group(function () {
            Route::post('process', 'CartController@processActions');
            Route::post('update-item-quantity', 'CartController@updateQuantity');
            Route::get('items', 'CartController@cartItems');
            Route::post('checkout', 'CartController@processCheckout');
        });

        Route::as('wishlist.')->prefix("wishlist")->middleware('auth:api')->group(function () {
            Route::post('process', 'WishlistController@processActions');
            Route::get('items', 'WishlistController@wishlistItems');
        });
    });
});
