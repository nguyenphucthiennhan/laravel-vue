<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAuth;
use App\Models\UserLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('images')->get();
        return $products;
    }
    public function details($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return $product;
    }
    public function categories()
    {
        $category = Category::get();
        return $category;
    }
    public function productsByCate($id)
    {
        $products = Product::join('category_product as cp', 'products.id', '=', 'cp.product_id')
            ->join('categories as c', 'c.id', '=', 'cp.category_id')
            ->select(
                'products.id',
                'products.name',
                'products.description',
                'products.price',
                'products.status',
                'products.discount',
                'products.download',
                'products.like',
                'products.comment',
                'c.name as category'
            )
            ->where('c.id', $id)
            ->with('images')
            ->get();
        return $products;
    }
    public function search($searchKeyword)
    {
        $products = Product::where('name', 'like', '%' . $searchKeyword . '%')->with('images')->get();
        return $products;
    }
    public function register(Request $request)
    {
        $user = UserAuth::where('email', $request->email)->first();

        if ($user) {
            return 0;
        }
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return 1;
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        } else {
            return 0;
        }
    }
    public function like(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        $like = UserLike::where('user_id', $user_id)->where('product_id', $product_id)->first();
        $product = Product::find($product_id); 
        if ($like) {
            $like = UserLike::where('user_id', $user_id)->where('product_id', $product_id)->delete();
            $product->like += -1; 
            $product->save(); 
            return 0;
        } else {
            $like = UserLike::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $product->like += 1; 
            $product->save(); 
            return $product->like;
        }
    }
    public function likeStatus(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        $like = UserLike::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if ($like) {
            return 1;
        } else {
           return 0;
        }
    }
}
