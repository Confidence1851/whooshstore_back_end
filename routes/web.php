<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

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
    return view('admin.products.index');
});

Route::namespace('App\Http\Controllers')->group(function (){
    Route::prefix('admin')->group(function (){
        
        Route::get('dashboard','AdminController@index')->name('admin');
        Route::get('products', 'ProductController@index')->name('adminProducts');

        Route::prefix('products')->group(function (){

            Route::get('add', 'ProductController@add')->name('addProducts');
            Route::get('edit', 'ProductController@edit')->name('editProducts');
            
        });

    });

});