<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


Route::resource('categories','CategoryController');

Route::get('categories/{id}/products', 'CategoryController@products');

Route::resource('products','ProductController')->middleware('auth:api');

Route::post('register','Auth\RegisterController@register');

Route::post('login','Auth\LoginController@apiLogin');


// Route::post('login',function (Request $request) {
//     error_log($request);
//     Log::debug($request->json()->all()['email']);
//     Log::debug($request->json()->all()['password']);

//     return response()->json([
//         'message'=>'Email or Password is incorrect'
//     ], 200); // Status code here
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('products/{product}/update','ProductController@updatePic')->middleware('auth:api');

Route::middleware('auth:api')->get('/user/products', function (Request $request) {
    return $request->user()->products;
});