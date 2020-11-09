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

Route::namespace('App\Http\Controllers\Api\v1')->prefix("v1")->group(function (){

    Route::namespace('Auth')->group(function (){
        Route::post('register','RegisterController@register');
        Route::post('login','LoginController@login');

        Route::as('auth.')->prefix("auth")->middleware('auth:api')->group(function (){

            Route::get('validate-token', 'VerificationController@validate_token');
            Route::get('email/verify/{id}', 'VerificationController@verify_email')->name('api.verify_email');
            Route::get('email/resend', 'VerificationController@resend_email')->name('api.resend_email');
            Route::get('verification-pin', 'VerificationController@sendVerificationEmail');
            Route::post('verify-email-pin', 'VerificationController@confirmVerificationPin');

        });
    });

});
