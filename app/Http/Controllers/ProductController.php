<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // dd(request()->header('Authorization'));
        // dd(auth()->user());
        $products = Product::query();
        if(auth()->user()->role == 'seller'){
            $products->where('user_id', auth()->user()->id);
        }
        if(request()->has('type')){
            $type = request()->type;
            switch($type){
                case 'books':
                    $products->where('category_id', 1);
                    break;
                case 'clothes':
                    $products->where('category_id', 2);
                    break;
            }
        }
        $products = $products->paginate(10);
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        // dd($request->header('Authorization'));
        // dd(auth()->user());
        $product = $request->all();
        $product['user_id'] = auth()->user()->id;
        $product['category_id'] = Category::first()->id;
        $product = Product::create($product);
        $product->addMediaFromRequest('image')->toMediaCollection('image');
        return new ProductResource($product);
    }

    public function show($id){
        $product = Product::find($id);
        return new ProductResource($product);
        // return response()->json($product);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }
}
