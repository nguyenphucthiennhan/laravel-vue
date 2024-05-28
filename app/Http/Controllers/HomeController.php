<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function index(){
        $products = Product::with('images')->get();
        return $products;
    }
    public function details($id){
        $product = Product::with('images')->findOrFail($id);
        return $product;
    }
    public function categories(){
        $category = Category::get();
        return $category;
    }
    public function productsByCate($id){
        $products = Product::join('category_product as cp', 'products.id', '=', 'cp.product_id')
        ->join('categories as c', 'c.id', '=', 'cp.category_id')
        ->select('products.id', 'products.name', 'products.description'
        , 'products.price', 'products.status', 'products.discount'
        , 'products.download', 'products.like', 'products.comment'
        ,'c.name as category')
        ->where('c.id', $id)
        ->with('images')
        ->get();  
        return $products;
    }
}
