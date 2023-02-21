<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\productsvalidation;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::get();
    }
    /**
     * Display Products by category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ProductsByCategory($categoryName)
    {
        $category = Category::where('name', $categoryName)->get();

        $products = Product::where('category_id', $category[0]->id)->get();
        $response = [
            'products' => $products,
            'category' => $categoryName
        ];
        return response($response, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(productsvalidation $request)
    {
        $fields=$request->validated();
        return Product::create([
            'title'=>$fields['title'],
            'description'=>$fields['description'],
            'price'=>$fields['price'],
            'category_id'=>$fields['category_id']
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        $category=Category::find($product->category_id)->name;
        $response = [
            'product' => $product,
            'category' => $category
        ];
        return response($response, 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
    }
}
