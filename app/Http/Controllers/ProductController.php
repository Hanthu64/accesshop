<?php

namespace App\Http\Controllers;

use App\Enums\Category;
use App\Models\Product;
use App\Models\Shop;
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

    public function show($id, Request $request){
        $product = Product::query()->findOrFail($id);
        $categories = Category::cases();
        if($request -> query('sortBy') == "price"){
            $sorter = $product -> shop -> sortBy(function($product) {
                return $product->pivot->price;
            });
        }else{
            $sorter = $product -> shop -> sortByDesc(function($product) {
                return $product->pivot->rating;
            });
        }

        return view('products-show', compact('product', 'categories', 'sorter'));
    }

    public function create(){
        $categories = Category::cases();
        return view('product-create-modal', compact('categories'));
    }
    public function delete($id){
        $product = Product::query()->find($id);
        $product -> shop() -> detach();
        $product->delete();
        return redirect('/profile');
    }

    public function edit($id){
        $shop = Shop::find(auth()->user()->shop_id);
        $product = $shop->product()->find($id);
        $categories = Category::cases();
        return view('product-edit-modal', auth()->user(), compact('product', 'categories'));
    }

    public function update(Request $request, $id){
        $shop = Shop::find(auth()->user()->shop_id);
        $product = $shop->product()->find($id);

        $product -> name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $product -> image = $file -> store('images', 'public');
        }else if($request->input('image')){
            return back()->withErrors(['image' => 'Imagen no encontrada.']) -> withInput($request->input());
        }

        $product -> category = $request->input('category');

        $product -> description = $request->input('description');

        $product -> view_description = $request->input('view_description');

        $product -> pivot -> price = $request->input('price');

        $product -> pivot -> rating = $request->input('rating');

        $product -> pivot -> product_link = $request->input('link');

        $product -> save();

        $product -> pivot -> save();

        return back();
    }

    public function store(Request $request){
        $product = new Product();

        $product -> name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $product -> image = $file -> store('images', 'public');
        }else if($request->input('image')){
            return back()->withErrors(['image' => 'Imagen no encontrada.']) -> withInput($request->input());
        }

        $product -> category = $request->input('category');

        $product -> description = $request->input('description');

        $product -> view_description = $request->input('view_description');

        $product -> save();

        $shop = Shop::find(auth()->user()->shop_id);

        $product->shop()->attach($shop->id, [
            'price' => $request->input('price'),
            'rating' => $request->input('rating'),
            'product_link' => $request->input('link'),
        ]);

        return back();
    }
}
