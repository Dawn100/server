<?php

use Illuminate\Http\Request;


Route::resource('categories','CategoryController')->middleware('cors');
Route::get('categories/{id}/products', 'CategoryController@products')->middleware('cors');;

Route::resource('products','ProductController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});