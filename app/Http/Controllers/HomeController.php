<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function products()
    {
        $products = Product::with(['category'])->latest()->paginate(6);
        if($products)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $products
            ]);
    }

    public function categories()
    {
        $categories = ProductCategory::latest()->paginate(6);
        if($categories)
            return response()->json([
                'state' => true,
                'message' => 'success',
                'data' => $categories
            ]);
    }
}
