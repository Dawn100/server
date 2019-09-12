<?php

use Illuminate\Http\Request;

Route::resource('categories','CategoryController')->middleware('cors');

Route::get('categories/{id}/products', 'CategoryController@products')->middleware('cors');

Route::resource('products','ProductController')->middleware('auth:api')->middleware('cors');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user/products', function (Request $request) {
    return $request->user()->products;
});