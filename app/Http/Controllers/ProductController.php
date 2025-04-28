<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $q){
        $categories = Category::cases();
        $products = Product::query();

        if($q -> filled('search')){
            $products = $products -> where('name', 'like', '%' . $q -> search . '%') -> get();
        }else{
            $products = Product::all()->sortByDesc("rating");
        }

        return view('index', compact('products', 'categories'));
    }

    public function filter($category){
        $categories = Category::cases();
        $products = Product::all();
        $products = $products->where('category', $category)->sortByDesc("rating");
        return view('index', compact('products', 'categories'));
    }
    public function show($id){
        $product = Product::query()->findOrFail($id);
        $categories = Category::cases();
        return view('products-show', compact('product', 'categories'));
    }
}
