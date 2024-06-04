<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Category_Product;
use App\Models\Image;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAuth;
use App\Models\UserLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


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
    public function liked($id)
    {
        $products =
            Product::join('userlike', 'products.id', '=', 'userlike.product_id')
            ->join('users', 'users.id', '=', 'userlike.user_id')
            ->select('products.*')
            ->with('images')
            ->where('users.id', '=', $id)
            ->get();
        return $products;
    }
    public function addToCart(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        $cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        if ($cart) {
            return 0;
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            return 1;
        }
    }
    public function destroye(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        Cart::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return 1;
    }
    public function destroyLike(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        UserLike::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        $product = Product::find($product_id);
        $product->like += -1;
        $product->save();
        return 1;
    }
    public function cart($id)
    {
        $products =
            Product::join('carts', 'products.id', '=', 'carts.product_id')
            ->join('users', 'carts.user_id', '=', 'users.id')
            ->where('users.id', $id)
            ->select('products.*')
            ->with('images')
            ->get();

        return $products;
    }
    public function pay(Request $request)
    {
        $user_id = $request->input('user_id');
        $products = $request->input('products');
        foreach ($products as $product) {
            $payment = new Payment;
            $payment->user_id = $user_id;
            $payment->product_id = $product['id'];
            $payment->amount = $product['discount'];
            $payment->created_at = now();
            $payment->updated_at = now();
            $payment->save();
        }
        Cart::where('user_id', $user_id)->delete();
        return 1;
    }
    public function paymentStatus(Request $request)
    {
        $user_id = $request->input('user_id');
        $product_id = $request->input('product_id');
        if (Payment::where('user_id', $user_id)->where('product_id', $product_id)->first()) {
            return 1;
        } else {
            return 0;
        }
    }
    public function getYourGames($id)
    {
        $products =
            Product::join('payments', 'products.id', '=', 'payments.product_id')
            ->join('users', 'users.id', '=', 'payments.user_id')
            ->where('users.id', $id)
            ->select('products.*')
            ->with('images')
            ->get();
        return $products;
    }
    public function getTrendingGames()
    {
        $products = Product::join('payments', 'products.id', '=', 'payments.product_id')
            ->select('products.*', DB::raw('COUNT(*) as frequency'))
            ->with('images')
            ->groupBy('products.id')
            ->orderBy(DB::raw('COUNT(*)'), 'DESC')
            ->take(4)
            ->get();
        return $products;
    }
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->get('productName');
        $product->price = $request->get('productPrice');
        $product->description = $request->get('productDescription');
        $product->status = 1;
        $product->discount = 0;
        $product->download = 0;
        $product->like = 0;
        $product->comment = 0;
        $product->save();
        $cate = $request->get('categoriesId');
        foreach ($cate as $c) {
            $category_product = new Category_Product;
            $category_product->category_id = $c;
            $category_product->product_id = $product->id;
            $category_product->save();
        }
        if ($request->hasfile('productImage')) {
            foreach ($request->file('productImage') as $file) {
                $name = time() . '_' . $file->getClientOriginalName();
                if (!file_exists(resource_path('images'))) {
                    mkdir(resource_path('images'), 0777, true);
                }
                $file->move(resource_path('images'), $name);

                $img = new Image;
                $img->name = $name;
                $img->product_id = $product->id;
                $img->save();
            }
        }

        return response()->json(['message' => 'Product created successfully']);
    }
    public function destroyProduct($id)
    {
        $product = Product::find($id);
        Category_Product::where('product_id', $product->id)->delete();
        foreach ($product->images as $image) {
            File::delete(resource_path('images/' . $image->name));
            $image->delete();
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
    public function revenue()
    {
        $revenueByDay = Payment::selectRaw('DATE(created_at) as date, SUM(amount) as revenue')
            ->groupBy('date')
            ->get();

        return $revenueByDay;
    }
    public function revenueM()
    {
        $revenueByMonth = Payment::selectRaw('MONTH(created_at) as date, YEAR(created_at) as year, SUM(amount) as revenue')
        ->groupBy('year', 'date')
        ->get();

    return $revenueByMonth;
    }
    public function getLimitedProductCount()
    {
        $products = Product::query()
            ->from('products as p')
            ->join('payments as pm', 'p.id', '=', 'pm.product_id')
            ->select('p.name', Product::raw('COUNT(pm.id) as total_quantity'))
            ->groupBy('p.name')
            ->orderBy('total_quantity', 'DESC')
            ->limit(7)
            ->get();
        return $products;
    }
}
