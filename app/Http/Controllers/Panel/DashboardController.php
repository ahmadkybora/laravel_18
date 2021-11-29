<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::get()->count();
        $products = Product::get()->count();
        $categories = ProductCategory::get()->count();

        return response()->json([
            'state' => true,
            'message' => '', 
            'data' => [
                'users' => $users,
                'products' => $products,
                'categories' => $categories
            ], 
        ]);
    }
}
