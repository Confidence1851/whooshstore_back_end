<?php

// define(PHP_VERSION, "7.4.8");

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/file/{path}', 'WebController@read_file')->name('read_file');

    Route::prefix('admin')->group(function () {
        Route::middleware(['is_admin'])->group(function () {
            Route::get('dashboard', 'HomeController@adminHome')->name('admin.dashboard');

            // Admin products
            Route::namespace('Admin')->group(function () {
                Route::resource('productcategories', 'ProductCategoryController')->names([
                    'index' => 'index.productcategories'
                ]);
                Route::resource('products', 'ProductController')->names([
                    'index' => 'index.products'
                ]);
                Route::get('/products/images/{product}', 'ProductController@images')->name('products.images');
                Route::post('/products.save-image', 'ProductController@saveImage')->name('products.image.save');
                Route::post('/products/delete-image/{productImageId}', 'ProductController@deleteImage')->name('products.image.delete');

                Route::resource('users', 'UsersController')->names([
                    'index' => 'index.users'
                ]);
                Route::get('/vendors/approve', 'VendorsController@approve')->name('vendors.approve');
                Route::post('/vendors/approveProduct/{id}', 'VendorsController@approveProduct')->name('approveProduct');
                Route::resource('vendors', 'VendorsController')->names([
                    'index' => 'index.vendors'
                ]);
            });
        });
    });
    Route::get('/home', 'HomeController@index')->name('home');
});
Auth::routes();


// Route::get('products', 'ProductController@index')->name('adminProducts');

// Route::prefix('products')->group(function (){

//     Route::get('add', 'ProductController@add')->name('addProducts');
//     Route::get('edit', 'ProductController@edit')->name('editProducts');
    
// });

// ['register' => false]
// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
