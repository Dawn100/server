<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all();
        foreach ($products as $product) {
            $product->photo=url($product->photo);
            $product->description=substr($product->description,0,50);
        }
        return $products->load('user')->load('category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $p=new Product;

        $p->category_id=$request->category_id;
        $p->user_id=$request->user()->id;

        $p->name=$request->name;
        $p->description=$request->description;
        $p->price= $request->price;

        $p->photo= "/storage/".$request->file('photo')->store("photos");
        $p->stock= $request->stock;

        $p->save();
        error_log($p);
        return response()->json([
            'status' => '201',
            'message' => 'Product created',
            'product'=>$p
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->photo=url($product->photo);
        return $product->load('user')->load('category');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // error_log($request);
        
        $product->category_id=$request->category_id;
        $product->user_id=$request->user()->id;

        $product->name=$request->name;
        $product->description=$request->description;
        $product->price= $request->price;

        //$product->photo= "/storage/".$request->file('photo')->store("photos");

        $product->stock= $request->stock;

        $product->save();
        // error_log($product);
        return response()->json([
            'status' => '201',
            'message' => 'Product updated',
            'product'=>$product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        error_log($product);
        $product->delete();
        return response()->json([
            'status' => '204',
            'message'=>'deleted'
        ]);
    }

    public function updatePic(Request $request,$product)
    {
        $product=Product::findOrFail($product);
        $product->photo= "/storage/".$request->file('photo')->store("photos");
        $product->save();
        return response()->json([
            'message' => 'Photo Updated',
            'new_url'=>$product->photo,
        ]);
    }
}
