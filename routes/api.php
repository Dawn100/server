<?php

use Illuminate\Http\Request;


Route::resource('categories','CategoryController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
