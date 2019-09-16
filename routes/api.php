<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Product;


Route::resource('categories','CategoryController');

Route::get('categories/{id}/products', 'CategoryController@products');

Route::resource('products','ProductController')->middleware('auth:api');

Route::post('register','Auth\RegisterController@register');

Route::post('login','Auth\LoginController@apiLogin');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('search',function (Request $request)
{
    $products = Product::where('name',$request->searchterm)->get();
    // $products=Product::all();
    foreach ($products as $product) {
        $product->photo=url($product->photo);
    }
    error_log($products);

    return $products->load('user')->load('category');
});

Route::post('products/{product}/setphoto','ProductController@updatePic')->middleware('auth:api');

Route::middleware('auth:api')->get('/user/products', function (Request $request) {
    $products=$request->user()->products;
    foreach ($products as $product) {
        $product->photo=url($product->photo);
        $product->description=substr($product->description,0,50);
    }
    return $products;
});